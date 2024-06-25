<html class="profil">
<?php
session_start();
if (isset($_SESSION['autoriser']) && $_SESSION['autoriser'] == "oui") {
    $autoriser = 1;
    $idconnect = $_SESSION['identifiant'];

    // Connexion à la base de données
    require_once 'BDD.php';

    // Vérifiez si le formulaire de modification des données utilisateur a été soumis
    if (isset($_POST['modifierDonneesUtilisateur'])) {
        // Mettez à jour les données de l'utilisateur dans la base de données
        $sql_update_utilisateur = $pdo->prepare("UPDATE utilisateurs 
                                                SET nom = ?, prenom = ?, age = ?, email = ?, identifiant = ? 
                                                WHERE identifiant = ?");
        $sql_update_utilisateur->execute([
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['age'],
            $_POST['email'],
            $_POST['identifiant'],
            $idconnect
        ]);

        // Redirigez l'utilisateur vers la page de profil après la mise à jour
        header("Location: profil.php");
        exit();
    }

    // Vérifiez si le formulaire de modification du mot de passe a été soumis
    if (isset($_POST['modifierMotDePasse'])) {
        // Validation et mise à jour du mot de passe
        $ancienMotDePasse = $_POST['ancienMotDePasse'];
        $nouveauMotDePasse = $_POST['nouveauMotDePasse'];
        $confirmationMotDePasse = $_POST['confirmationMotDePasse'];

        $sql_verifier_mot_de_passe = $pdo->prepare("SELECT mdp FROM utilisateurs WHERE identifiant = ?");
        $sql_verifier_mot_de_passe->execute([$idconnect]);
        $motDePasseBD = $sql_verifier_mot_de_passe->fetchColumn();

        if (password_verify($ancienMotDePasse, $motDePasseBD)) {
            // Ancien mot de passe valide, continuez avec la mise à jour
            if ($nouveauMotDePasse === $confirmationMotDePasse) {
                // Nouveau mot de passe confirmé, mettez à jour dans la base de données
                $nouveauMotDePasseHash = password_hash($nouveauMotDePasse, PASSWORD_DEFAULT);

                $sql_mise_a_jour_mot_de_passe = $pdo->prepare("UPDATE utilisateurs SET mdp = ? WHERE identifiant = ?");
                $sql_mise_a_jour_mot_de_passe->execute([$nouveauMotDePasseHash, $idconnect]);

                echo '<script>alert("Mot de passe mis à jour avec succès!");</script>';
            } else {
                echo '<script>alert("Erreur : La confirmation du nouveau mot de passe ne correspond pas.");</script>';
            }
        } else {
            echo '<script>alert("Erreur : Ancien mot de passe incorrect.");</script>';
        }
    }

    // Requête SQL pour récupérer les données de l'utilisateur
    $sql_select_utilisateur = $pdo->prepare("SELECT * FROM utilisateurs WHERE identifiant = ?");
    $sql_select_utilisateur->execute([$idconnect]);
    $utilisateur = $sql_select_utilisateur->fetch(PDO::FETCH_OBJ);
} else {
    $autoriser = 0;
}
?>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css"/>
        <title>Profil</title>
    </head>
<body class="profil">
    <div id="app">
        <div class="contenu_profil">
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

            <div id="container_profil">
                <?php if (isset($utilisateur)) : ?>
                    <div class="profil_card">
                        <!-- Formulaire pour valider les modifications utilisateur -->
                        <form method="post" action="profil.php">
                            <div class="profil_image">
                                <img src="image/utilisateur.png" alt="Image de l'utilisateur">
                            </div>

                            <div class="profil_info">
                                <label>Nom : <input name="nom" value="<?php echo isset($utilisateur->nom) ? $utilisateur->nom : ''; ?>" placeholder="Nom" /></label><br><br>
                                <label>Prenom : <input name="prenom" value="<?php echo isset($utilisateur->prenom) ? $utilisateur->prenom : ''; ?>" placeholder="Prenom" /></label><br><br>
                                <label>Age : <input name="age" value="<?php echo isset($utilisateur->age) ? $utilisateur->age : ''; ?>" placeholder="Âge" /></label><br><br>
                                <label>Email : <input name="email" value="<?php echo isset($utilisateur->email) ? $utilisateur->email : ''; ?>" placeholder="Email" /></label><br><br>
                                <label>Identifiant : <input type="text" name="identifiant" value="<?php echo isset($utilisateur->identifiant) ? $utilisateur->identifiant : ''; ?>" placeholder="Identifiant" readonly /></label><br><br>
                            </div>

                            <div class="profil_button">
                                <button type="submit" name="modifierDonneesUtilisateur">Valider les modifications</button>
                            </div>
                        </form>

                        <!-- Formulaire pour modifier le mot de passe -->
                        <form method="post" action="profil.php">
                            <div class="profil_button">
                                <button id="boutonMotDePasse" type="button" onclick="afficherSectionMotDePasse()">Modifier le mot de passe</button>
                            </div>

                            <!-- Nouvelle section pour le formulaire de modification du mot de passe -->
                            <div id="sectionMotDePasse" style="display: none;">
                                <label for="ancienMotDePasse">Ancien mot de passe:</label>
                                <input type="password" name="ancienMotDePasse" required><br><br>

                                <label for="nouveauMotDePasse">Nouveau mot de passe:</label>
                                <input type="password" name="nouveauMotDePasse" required><br><br>

                                <label for="confirmationMotDePasse">Confirmer le nouveau mot de passe:</label>
                                <input type="password" name="confirmationMotDePasse" required><br><br>

                                <div class="profil_button">
                                    <button type="submit" name="modifierMotDePasse">Valider le nouveau mot de passe</button>
                                </div>
                            </div>
                        </form>

                    </div>
                <?php else : ?>
                    <p>Erreur : Utilisateur non trouvé.</p>
                <?php endif; ?>
            </div>

            <script src="js/profil.js"></script>

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

    </div>
</body>

</html>