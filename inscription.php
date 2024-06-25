<?php

require_once 'BDD.php';

$errorMessage = '';

if (isset($_POST['envoie'])) {
    $id = trim($_POST['identifiant']);
    $mdp = $_POST['mdp'];
    $mdphash = password_hash($mdp, PASSWORD_DEFAULT);

    $sql = $pdo->prepare("SELECT * FROM utilisateurs WHERE identifiant = ?");
    $sql->execute([$id]);
    $utilExiste = $sql->fetchAll(PDO::FETCH_OBJ);

    if (count($utilExiste) == 0) {
        $ins = $pdo->prepare('INSERT INTO utilisateurs (identifiant, mdp) VALUES (:id, :mdp)');
        $ins->execute([
            'id' => $id,
            'mdp' => $mdphash,
        ]);
        header("Location: connexion.php");
        exit();
    } else {
        $errorMessage = "Veuillez saisir un autre identifiant, celui-ci existe déjà";
    }
}

?>

<!DOCTYPE html>
<html class="inscription_connexion">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css"/>
    <title>Inscription</title>
</head>
<body class="inscription_connexion">
<div class="contenue_inscription">
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
            <a href="connexion.php" class="bandeau_url"><img src="image/utilisateur.png" class="utilisateur"></a>
        </div>
    </div>
    <div class="contenue_formulaire_inscription">
        <div class="formulaire_inscription">
            <div class="texte_inscrption">
                <h1 class="titre_inscription">Inscription</h1>
                <p class="message_inscription">Bonjour bienvenue dans l'espace inscription si dessous vous pouvez vous inscrire a Tech-News et profiter de nos différentes options ajoutées pour nos utilisateurs</p>
            </div>
            <section class="cadre_inscription">
                <form method="POST">
                    <span class="titre_cadre_inscription">Identifiant</span>
                    <br><br>
                    <input class="recuperation_inscription" type="text" name="identifiant" size="25" maxlength="25" required>
                    <br><br>
                    <span class="titre_cadre_inscription">Mot de passe</span>
                    <br><br>
                    <input class="recuperation_inscription" type="password" name="mdp" size="25" minlength="8" required>
                    <br><br>
                    <input class="envoyer_inscription" type="submit" name="envoie" value="envoyer">
                    <br>
                </form>
            </section>
            <div class="inscription_to_connexion">
                <label>Si vous avez déjà un compte, veuillez cliquer sur ce <a href="connexion.php">lien</a></label>
            </div>
        </div>
        <div class="inscription_information">
            <label class="titre_inscription_information">Voici les différents avantages de vous inscrire sur notre site :</label>
            <br><br>
            <ul>
                <li class="avantage_inscription_titre">Mise à jour régulière
                    <br><br>
                    <label class="avantage_inscription_texte">Recevez régulièrement les dernières nouvelles et avancées en informatique en vous inscrivant sur ce site d'actualité.</label>
                </li>
                <li class="avantage_inscription_titre">Personnalisation de l'information
                    <br><br>
                    <label class="avantage_inscription_texte">Choisissez vos préférences pour recevoir des informations spécifiques qui correspondent à vos centres d'intérêt informatiques.</label>
                </li>
                <li class="avantage_inscription_titre">Accès à des analyses approfondies
                    <br><br>
                    <label class="avantage_inscription_texte">Accédez à des articles approfondis, des critiques et des analyses sur des sujets technologiques spécifiques.</label>
                </li>
                <li class="avantage_inscription_titre">Communauté et partage d'expérience
                    <br><br>
                    <label class="avantage_inscription_texte">Participez à des forums, partagez des expériences et échangez des idées avec d'autres passionnés de technologie.</label>
                </li>
            </ul>
        </div>
    </div>
</div>

<?php if (!empty($errorMessage)) : ?>
    <div class="inscription_overlay active"></div>
    <div class="inscription_popup active">
        <h2>Erreur</h2>
        <p><?php echo $errorMessage; ?></p>
        <button onclick="closePopup()">Fermer</button>
    </div>
    <script>
        function closePopup() {
            document.querySelector('.inscription_overlay').classList.remove('active');
            document.querySelector('.inscription_popup').classList.remove('active');
        }
    </script>
<?php endif; ?>

</body>
</html>