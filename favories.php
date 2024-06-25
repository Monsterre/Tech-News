<html class="favories">
<?php
session_start();
if (isset($_SESSION['autoriser']) && $_SESSION['autoriser'] == "oui") {
    $autoriser = 1;
    $identifiant = $_SESSION['identifiant'];
    
    try {
        // Connexion à la base de données
        require_once 'BDD.php';
        
        // Requête pour récupérer l'ID de l'utilisateur en fonction de son identifiant
        $stmt = $pdo->prepare('SELECT IdU FROM utilisateurs WHERE identifiant = :identifiant');
        $stmt->execute(['identifiant' => $identifiant]);
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            $idconnect = $user['IdU'];
        } else {
            $idconnect = null;
        }
    } catch (PDOException $e) {
        echo 'Erreur de connexion : ' . $e->getMessage();
    }
} else {
    $autoriser = 0;
    $idconnect = null;
}
?>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css"/>
        <title>Profil</title>
        <script src="js/searchFavorie.js"></script>
        <script src="https://unpkg.com/vue@3"></script>
    </head>
<body class="favories">
    <div id="app">
        <div class="contenu_favories">
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

            <div id="container_favorie">
                <div class="texte_favorie">
                    Bienvenue dans vos Favoris
                </div>
                <div class="favorie_texte">
                    Vous retrouverez ici les différentes actualités, guides ou encore critiques que vous avez ajoutés à vos favoris.
                </div>
                <div class="barre_de_recherche_favorie">
                
                Choisissez une catégorie : &nbsp;&nbsp;

                <label>
                    <input type="checkbox" name="categories[]" value="Actualités"> Actualités
                </label>
                <label>
                    <input type="checkbox" name="categories[]" value="Critiques"> Critiques
                </label>
                <label>
                    <input type="checkbox" name="categories[]" value="Guides"> Guides
                </label>

                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                Rechercher : <input type="text" id="searchFavorieInput" placeholder="Rechercher...">

                </div>
            </div>

            <div id="contenu_favorie" class="contenu_favorie">
            <?php
            require_once 'BDD.php';

            // Id de l'utilisateur dont vous voulez récupérer les favoris
            $user_id = $idconnect;

            // Requêtes pour récupérer les favoris de chaque table
            $sql_favorites_actualites = "SELECT favories_actualitées.IdFA AS id, favories_actualitées.IdA, 'Actualités' AS category, actualitées.titre, actualitées.libelle, actualitées.auteur, actualitées.date_publication, actualitées.url_image, actualitées.url_actu FROM favories_actualitées INNER JOIN actualitées ON actualitées.IdA = favories_actualitées.IdA WHERE IdU = ?";
            $sql_favorites_guides = "SELECT favories_guides.IdFG AS id, favories_guides.IdG, 'Guides' AS category, guides.titre, guides.libelle, guides.auteur, guides.date_publication, guides.url_image, guides.url_guide FROM favories_guides INNER JOIN guides ON guides.IdG = favories_guides.IdG WHERE IdU = ?";
            $sql_favorites_critiques = "SELECT favories_critiques.IdFC AS id, favories_critiques.IdCR, 'Critiques' AS category, critiques.titre, critiques.libelle, critiques.auteur, critiques.date_publication, critiques.url_image, critiques.url_critique FROM favories_critiques INNER JOIN critiques ON critiques.IdCR = favories_critiques.IdCR WHERE IdU = ?";

            // Préparer les requêtes
            $stmt_actualites = $pdo->prepare($sql_favorites_actualites);
            $stmt_guides = $pdo->prepare($sql_favorites_guides);
            $stmt_critiques = $pdo->prepare($sql_favorites_critiques);

            // Lier les paramètres
            $stmt_actualites->bindParam(1, $user_id, PDO::PARAM_INT);
            $stmt_guides->bindParam(1, $user_id, PDO::PARAM_INT);
            $stmt_critiques->bindParam(1, $user_id, PDO::PARAM_INT);

            // Exécuter les requêtes
            $stmt_actualites->execute();
            $stmt_guides->execute();
            $stmt_critiques->execute();

            // Récupérer les résultats
            $favorites_actualites = $stmt_actualites->fetchAll(PDO::FETCH_OBJ);
            $favorites_guides = $stmt_guides->fetchAll(PDO::FETCH_OBJ);
            $favorites_critiques = $stmt_critiques->fetchAll(PDO::FETCH_OBJ);

            // Fusionner les résultats
            $result = array_merge($favorites_actualites, $favorites_guides, $favorites_critiques);

            // Ajouter une propriété libelle_truncate pour chaque favorie
            foreach ($result as $favorie) {
                $favorie->libelle_truncate = mb_strlen($favorie->libelle) > 100 ? wordwrap($favorie->libelle, 100, "\n", true) : $favorie->libelle;
            }

            $favories = json_encode($result); // Convertir les données en JSON
            ?>

            <?php
            foreach ($result as $key => $favorie) {
                $id_unique = 'favorie_' . $favorie->id;
                echo '<div class="favorie-container" id="' . $id_unique . '" data-category="' . $favorie->category . '" data-titre="' . $favorie->titre . '" data-libelle="' . $favorie->libelle . '" v-on:click="openFavorieModal(' . $key . ')">';

                // Première div avec l'image et le titre
                echo '<div class="favorie_image">';
                $wrappedTitle = wordwrap($favorie->titre, 20, "<br>", true);
                $trimmed_title = mb_strimwidth($wrappedTitle, 0, 40, '...');
                echo '<h1 class="titre_favorie" value="' . $favorie->titre . '">' . $trimmed_title . '</h1>';
                echo '<img src="' . $favorie->url_image . '">';
                echo '</div>';

                // Deuxième div avec le début de la description
                echo '<div class="favorie_minitexte">';
                $wrapped_text = wordwrap($favorie->libelle, 85, "<br>\n", true);
                $trimmed_text = mb_strimwidth($wrapped_text, 0, 795, '...');
                echo '<p data-libelle-truncate="' . $favorie->libelle . '">' . $trimmed_text . '</p>';
                echo '</div>';

                // Informations supplémentaires dans les attributs data-*
                echo '<div class="favorie_info" 
                    data-auteur="' . htmlspecialchars($favorie->auteur) . '"
                    data-date-publication="' . htmlspecialchars($favorie->date_publication) . '"';

                // Condition pour attribuer l'URL appropriée en fonction de la catégorie
                switch ($favorie->category) {
                    case 'Actualités':
                        echo ' data-url-favorie="' . htmlspecialchars($favorie->url_actu) . '"';
                        break;
                    case 'Guides':
                        echo ' data-url-favorie="' . htmlspecialchars($favorie->url_guide) . '"';
                        break;
                    case 'Critiques':
                        echo ' data-url-favorie="' . htmlspecialchars($favorie->url_critique) . '"';
                        break;
                    default:
                        echo ' data-url-favorie=""'; // Fallback si la catégorie n'est pas reconnue
                }

                echo ' style="display: none;"></div>';

                // Ajout de l'icône de poubelle
                echo '<div class="trash-icon-container">';
                echo '<img class="trash-icon" id="trash_' . $favorie->id . '" src="image/corbeille.png" alt="Poubelle" onclick="deleteFavorite(' . $favorie->id . ', \'' . $favorie->category . '\', event)">';
                echo '</div>';

                echo '</div>';
            }
            ?>

            <!-- Modale sans Bootstrap -->
            <div v-if="ifShow" id="modal-container" class="modal-container">
                <div class="modal-content">
                <h2>{{ favorieData.titre }}</h2>
                <img v-if="favorieData.image" :src="favorieData.image" alt="Image de la favorie">
                <h3>Auteur: {{ favorieData.auteur }}</h3>
                <h3>Date de publication: {{ favorieData.date_publication }}</h3>
                <p>{{ favorieData.libelle_truncate }}</p>
                <a :href="favorieData.url_favorie" target="_blank">Lien vers l'actualitée</a>
                    <labelle class="modal-close" v-on:click="closeFavorieModal">X</labelle>
                </div>
            </div>

        </div>
                

        <footer class="accueil">
                <div class="container_accueil">
                    <div class="libelle">
                        <?php
                            if($autoriser == 1){
                                echo "<p>Connecté en tant que : " . $identifiant . "<a href='deconnexion.php' class='deconnexion_pied'> ( Se Déconnecter )</a></p>";
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

    </div>

    <script>
    function deleteFavorite(favorieId, category, event) {
        event.stopPropagation(); // Empêche la propagation du clic pour ne pas ouvrir la modal

        // Requête AJAX pour supprimer le favori
        fetch('deleteFavorite.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ id: favorieId, category: category }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Supprime l'élément du DOM
                document.getElementById('favorie_' + favorieId).remove();
                // Rafraîchir la page
                location.reload();
            } else {
                alert('Erreur lors de la suppression du favori.');
            }
        })
        .catch((error) => {
            console.error('Error:', error);
            alert('Erreur lors de la suppression du favori.');
        });
    }
    </script>


    <script>
        const favories = <?php echo $favories; ?>;
    </script>
    <script src="js/modalFavorie.js"></script>
</body>

</html>