<?php
    require_once 'BDD.php';
    session_start();
    $id = $_POST['identifiant'] ?? "";
    $mdp= $_POST['mdp'] ?? "";
    $erreur = "";

    if (isset($_POST['connexion'])){
        $id = $_POST['identifiant'];
        $mdp = htmlspecialchars($_POST['mdp']);
        $sql = $pdo->prepare("SELECT * FROM utilisateurs WHERE identifiant = ?");
        $sql->execute([$id]);
        $utilExiste = $sql->fetchAll(PDO::FETCH_OBJ);
        $nb_result = count($utilExiste);

        if ($nb_result == 0) {
            $erreur = "Identifiant ou mot de passe incorrect";
            $_SESSION['errorMessage'] = $erreur;
            header("Location: connexion.php");
            exit();
        }

        if ($utilExiste) {
            $idverif = $utilExiste[0]->identifiant;
            $mdpverif = $utilExiste[0]->mdp;
            if ($idverif == $id && password_verify($mdp, $mdpverif)) {
                $_SESSION['identifiant'] = $id;
                $_SESSION['autoriser'] = "oui";
                header("Location: index.php");
                exit();
            } else {
                $erreur = "Identifiant ou mot de passe incorrect";
                $_SESSION['errorMessage'] = $erreur;
                header("Location: connexion.php");
                exit();
            }
        }
    }

    if (isset($_SESSION['errorMessage'])) {
        $errorMessage = $_SESSION['errorMessage'];
        unset($_SESSION['errorMessage']);
    } else {
        $errorMessage = "";
    }
?>

<html class="inscription_connexion">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/style.css"/>
<title>Connexion</title>
</head>
<body class="inscription_connexion">

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

<div class="contenue_connexion">
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
            <a href="connexion.php" class="bandeau_url"><img src="image\utilisateur.png" class="utilisateur"></a>
        </div>
    </div>
    <div class="contenue_formulaire_connexion">
        <div class="formulaire_connexion">
            <div class="texte_connexion">
                <h1 class="titre_connexion">Connexion</h1>
                <p class="message_connexion">Bonjour bienvenue dans l'espace de connexion si dessous vous pourrez vous connecter est acceder, plus librement, sans aucune limite à notre site</p>
            </div>
                <section class="cadre_connexion">
                <form method="POST">
                <span class="titre_cadre_connexion">Identifiant</span>
                <br>
                <br>
                <INPUT class="recuperation_connexion" type="text" name="identifiant" size="25" required>
                <br>
                <br>
                <span class="titre_cadre_connexion">Mot de passe</span>
                <br>
                <br>
                <INPUT class="recuperation_connexion" type="password" name="mdp" size="25" required>
                <br>
                <br>
                <INPUT class="envoyer_connexion" TYPE="submit" NAME="connexion" VALUE="envoyer" action="connexion.php" >
                <br>
                </form>
            </section>
            <div class="connexion_to_inscription">
                <libelle>Si vous n'avait pas de compte veillez en crée un en cliquant sur ce <a href="inscription.php">lien</a></libelle>
            </div>
        </div>
    </div>


</div>
</body>
</html>