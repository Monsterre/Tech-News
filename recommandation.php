<html class="recommandation">
<?php
session_start();
if (isset($_SESSION['autoriser']) && $_SESSION['autoriser'] == "oui") {
    $autoriser = 1;
    $idconnect = $_SESSION['identifiant'];
}
else {
    $autoriser = 0;
}
?>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css"/>
        <script src="js/searchRecommandation.js"></script>
        <script src="https://unpkg.com/vue@3"></script>
        <title>Recommandation</title>
    </head>
<body class="recommandation">
    <div class="contenu_recommandation">
        <div class="bandeau">
            <div class="logo">
                <a href="index.php" class="bandeau_url"><h1>Tech-News</h1></a>
            </div>
            <div class="actualitées_bandeau">
                <a href="actualitées.php" class="bandeau_url">Actualités</a>
            </div>
            <div class="guides_bandeau">
                <a href="guides.php" class="bandeau_url">Guides</a>
            </div>
            <div class="critiques_bandeau">
                <a href="critiques.php" class="bandeau_url">Critiques</a>
            </div>
            <div class="recommandation_bandeau">
                <a href="recommandation.php" class="bandeau_url">Recommandations</a>
            </div>
            <div class="compte_bandeau">
                <a href="<?php echo isset($autoriser) && $autoriser == 1 ? 'profil.php' : 'connexion.php'; ?>" class="bandeau_url" id="userIcon">
                    <img src="image/utilisateur.png" class="utilisateur">
                </a>
                <div class="dropdown" id="dropdownMenu">
                    <a href="profil.php">Profil</a>
                    <a href="favories.php">Favoris</a>
                    <a href="deconnexion.php">Déconnexion</a>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var isUserAuthorized = <?php echo isset($autoriser) && $autoriser == 1 ? 'true' : 'false'; ?>;
                    var userIcon = document.getElementById('userIcon');
                    var dropdownMenu = document.getElementById('dropdownMenu');

                    if (isUserAuthorized) {
                        userIcon.addEventListener('click', function(event) {
                            event.preventDefault();
                            if (dropdownMenu.style.display === 'block') {
                                dropdownMenu.style.display = 'none';
                            } else {
                                dropdownMenu.style.display = 'block';
                            }
                        });
                    }
                });
            </script>

        </div>

        <div id="container_recommandation">

            <div class="div_recherche_recommandation">
                <label><b>Rechercher :</b></label><br><br>
                <input type="text" id="searchRecommandationInput" placeholder="Rechercher avec le nom..."><br><br>
                <label><b>Catégories :</b></label><br><br>
                <?php
                require_once 'BDD.php';

                $sql_liste_categories = $pdo->prepare("SELECT catégories.IdC, catégories.nom FROM `catégories` 
                                                        GROUP BY `IdC`;");
                $sql_liste_categories->execute();
                $result = $sql_liste_categories->fetchAll(PDO::FETCH_OBJ);
                
                // Affichage des catégories avec des cases à cocher
                foreach ($result as $categorie) {
                    echo '<label>';
                    echo '<input type="checkbox" name="categories[]" value="' . $categorie->nom . '">';
                    echo $categorie->nom;
                    echo '</label>';
                    echo '<br><br>';
                }            
                ?>
            </div>
            <div class="div_produit_recommandation">
                <div class="produits-container">
                    <?php
                    require_once 'BDD.php';
                    $sql_liste_produits = $pdo->prepare("SELECT produits.IdP, produits.nom, produits.libelle, catégories.nom as categorie_nom, produits.url_produit, produits.image_produit 
                                        FROM produits 
                                        JOIN catégories ON produits.IdC = catégories.IdC 
                                        GROUP BY IdP;");
                    $sql_liste_produits->execute();
                    $result = $sql_liste_produits->fetchAll(PDO::FETCH_OBJ);

                    // Ajoutez une propriété libelle_truncate pour chaque recommandation
                    foreach ($result as $recommandation) {
                        $recommandation->libelle_truncate = mb_strlen($recommandation->libelle) > 100 ? wordwrap($recommandation->libelle, 100, "\n", true) : $recommandation->libelle;
                    }
                    
                    $recommandations = json_encode($result);

                    foreach ($result as $key => $produit) {
                        $id_unique = 'produit_' . $produit->IdP;
                        echo '<div class="produit-container" id="' . $id_unique . '" data-nom="' . $produit->nom . '" data-categorie="' . $produit->categorie_nom . '" v-on:click="openRecommandationModal(' . $key . ')">';

                        // Première div avec l'image
                        echo '<div class="produit_image">';
                        echo '<img src="' . $produit->image_produit . '">';
                        echo '</div>';

                        // Deuxième div avec le nom
                        echo '<div class="produit_nom">';
                        $wrapped_text = wordwrap($produit->nom, 50, true);
                        $trimmed_text = mb_strimwidth($wrapped_text, 0, 50, '...');
                        echo '<p class="nom_produit" data-libelle-truncate="' . htmlspecialchars($trimmed_text) . '" value="'. $produit->nom .'">' . $trimmed_text . '</p>';
                        echo '</div>';

                        echo '</div>';
                    }
                    ?>
                </div>
            </div>

            <!-- Modale sans Bootstrap -->
            <div v-if="ifShow" id="modal-container" class="modal-container">
                <div class="modal-content">
                <img v-if="recommandationData.image" :src="recommandationData.image" alt="Image de la Recommandation">
                <h2>{{ recommandationData.nom }}</h2>
                <p>Catégorie : {{ recommandationData.categorie }}</p>
                <p><a :href="recommandationData.url_produit">Cliquez sur ce lien pour accéder au Site Web</a></p>
                <p>{{ recommandationData.libelle_truncate }}</p>
                    <labelle class="modal-close" v-on:click="closeRecommandationModal">X</labelle>
                </div>
            </div>

        </div>

        <footer class="accueil">
                <div class="container_accueil">
                    <div class="libelle">
                        <?php
                            if($autoriser == 1){
                                echo "<p>Connecté en tant que : " . $idconnect . "<a href='deconnexion.php' class='deconnexion_pied'> ( Se Déconnecter )</a></p>";
                            } else {
                                echo "<p>Non connecté <a href='connexion.php' class='connexion_pied'>( Se connecter )</a></p>";
                            }
                        ?>
                    </div>
                    <div class="white_underline"></div>
                    <div class="footer-content">
                        <div class="footer-section about">
                            <h3>À propos</h3>
                            <p>Sur ce site vous retrouveraient les différentes actualités, guides et critiques sur l'informatique ainsi que des recommandations faite par nos modérateurs.</p>
                        </div>
                        <div class="footer-section links">
                            <h3>Liens rapides</h3><br><br>
                            <a href="actualitées.php">Actualités</a><br><br><br>
                            <a href="guides.php">Guides</a><br><br><br>
                            <a href="critiques.php">Critiques</a><br><br><br>
                            <a href="recommandation.php">Recommandations</a><br><br><br>
                        </div>
                    </div>
                </div>
            </footer>

    </div>
    <script>
        const recommandations = <?php echo $recommandations; ?>;
    </script>
    <script src="js/modalRecommandation.js"></script>
</body>
</html>