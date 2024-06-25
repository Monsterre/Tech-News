<html class="accueil">

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
        <title>Accueil</title>
        <meta charset="utf-8">
        <link rel="stylesheet" media="screen" type="text/css" href="css/style.css" />
    </head>
    <body class="accueil">
        <div class="contenu_Accueil">
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
            <div class="texte_accueil">
                Bienvenue sur Tech-News
            </div>
            <div class="actualitées_accueil">
                <div id="actualitées_image">
                    <a href="actualitées.php">
                        <img src="image\actualitée.gif" class="actualitée_gif" href="actualitées.php">
                    </a>
                </div>
                <div class="actualitées_texte">
                    Vous retrouverait ici les différentes actualitées sur l'informatique ainsi que sur les produits High-Tech
                </div>
            </div>
            <div class="guide_accueil">
                <div class="guide_texte">
                    Vous retrouverait ici les différents guides sur l'informatique publiée par nos modérateur, ils vous permettront de mieux vous familiarisé avec les différents objets
                </div>
                <div id="guide_image">
                    <a href="guides.php">
                        <img src="image\guide.gif" class="guide_gif">
                    </a>
                </div>
            </div>
            <div class="critique_accueil">
                <div id="critique_image">
                    <a href="critiques.php">
                        <img src="image\critique.gif" class="critique_gif">
                    </a>
                </div>
                <div class="critique_texte">
                    Vous retrouverait ici les différentes critiques que ce soit de matériels, jeux vidéo ou de logiciel qu'on publiée nos modérateur et nos experts
                </div>
            </div>
            <div class="recommandation_accueil">
                <div class="recommandation_texte">
                    Vous retrouverait ici les différentes sites d'achat les mieux notées d'internet ainsi que les produits que nous recommendont
                </div>
                <div id="recommandation_image">
                    <a href="recommandation.php">
                        <img src="image\recommandation.gif" class="recommandation_gif">
                    </a>
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
    </body>
</html>
<?php

?>