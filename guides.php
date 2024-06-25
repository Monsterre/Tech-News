<html class="guides">
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
        <script src="js/searchGuide.js"></script>
        <script src="https://unpkg.com/vue@3"></script>
        <title>Guides</title>
    </head>
<body class="guides">
    <div class="contenu_guides">
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
        <div class="recherche_guides">
            <input type="text" id="searchGuideInput" placeholder="Rechercher avec le titre...">
        </div>
        <div id="contenu_guide" class="contenu_guides">
            <?php
            require_once 'BDD.php';
            $sql_liste_guides = $pdo->prepare("SELECT guides.IdG, guides.titre, guides.libelle, guides.url_image, guides.url_guide, guides.auteur, guides.date_publication FROM `guides` 
                                                    GROUP BY `IdG`;");
            $sql_liste_guides->execute();
            $result = $sql_liste_guides->fetchAll(PDO::FETCH_OBJ);

            // Ajoutez une propriété libelle_truncate pour chaque guide
            foreach ($result as $guide) {
                $guide->libelle_truncate = mb_strlen($guide->libelle) > 100 ? wordwrap($guide->libelle, 100, "\n", true) : $guide->libelle;
            }

            $guides = json_encode($result); // Convertir les données en JSON
            ?>
            <?php
            foreach ($result as $key => $guide) {
                $id_unique = 'guide_' . $guide->IdG;
                echo '<div class="guide-container" id="' . $id_unique . '" data-titre="' . $guide->titre . '" data-libelle="' . $guide->libelle . '" v-on:click="openGuideModal(' . $key . ')">';
                                
                // Première div avec l'image et le titre
                echo '<div class="guide_image">';
                $wrappedTitle = wordwrap($guide->titre, 20, "<br>", true);
                $trimmed_title = mb_strimwidth($wrappedTitle, 0, 40, '...');
                echo '<h1 class="titre_guide" value="'. $guide->titre .'">' . $trimmed_title . '</h1>';
                echo '<img src="' . $guide->url_image . '">';
                echo '</div>';
            
                // Deuxième div avec le début de la description
                echo '<div class="guide_minitexte">';
                $wrapped_text = wordwrap($guide->libelle, 85, "<br>\n", true);
                $trimmed_text = mb_strimwidth($wrapped_text, 0, 795, '...');
                echo '<p data-libelle-truncate="' . $guide->libelle . '">' . $trimmed_text . '</p>';
                echo '</div>';
                
                // Informations supplémentaires dans les attributs data-*
                echo '<div class="guide_info" 
                            data-auteur="' . htmlspecialchars($guide->auteur) . '"
                            data-date-publication="' . htmlspecialchars($guide->date_publication) . '"
                            data-url-guide="' . htmlspecialchars($guide->url_guide) . '"
                            style="display: none;"></div>';
                
                // Ajout du cœur cliquable
                echo '<div class="heart-icon-container">';
                echo '<img class="heart-icon" id="heart_' . $guide->IdG . '" src="image/coeur.png" alt="Cœur" onclick="addFavorite(' . $guide->IdG . ', event)">';
                echo '</div>';
                
                echo '</div>';
            }
            ?>

            <!-- Modale sans Bootstrap -->
            <div v-if="ifShow" id="modal-container" class="modal-container">
                <div class="modal-content">
                <h2>{{ guideData.titre }}</h2>
                <img v-if="guideData.image" :src="guideData.image" alt="Image du guide">
                <h3>Auteur: {{ guideData.auteur }}</h3>
                <h3>Date de publication: {{ guideData.date_publication }}</h3>
                <p>{{ guideData.libelle_truncate }}</p>
                <a :href="guideData.url_guide" target="_blank">Lien vers le guide</a>
                    <labelle class="modal-close" v-on:click="closeGuideModal">X</labelle>
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
        function addFavorite(guideId, event) {
        event.stopPropagation(); // Stoppe la propagation du clic pour ne pas ouvrir la modal

        // Appel de la fonction pour envoyer l'ID de l'utilisateur et du guide au serveur
        sendFavorite(guideId);
    }

    function sendFavorite(guideId) {
        // Effectuez une requête AJAX pour envoyer les ID au serveur
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Afficher une alerte ou effectuer d'autres actions si nécessaire
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        alert("Favori ajouté avec succès!");
                    } else {
                        alert("Erreur : " + response.message);
                    }
                } else {
                    alert("Une erreur est survenue lors de l'ajout du favori.");
                }
            }
        };

        xhr.open("GET", "favorie_ajout_guide.php?action=add_favorite&guideId=" + guideId, true);
        xhr.send();
    }


    </script>

    <script>
        const guides = <?php echo $guides; ?>;
    </script>
    <script src="js/modalGuide.js"></script>
</body>
</html>