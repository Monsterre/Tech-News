<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['autoriser']) && $_SESSION['autoriser'] == "oui" && isset($_SESSION['identifiant'])) {
    // Récupérer l'ID de l'utilisateur connecté
    $id_utilisateur = null;

    // Récupérer le nom d'utilisateur depuis la session
    $identifiant_utilisateur = $_SESSION['identifiant'];

    // Connexion à la base de données
    require_once 'BDD.php';

    try {
        // Effectuer une requête SQL pour obtenir l'ID de l'utilisateur
        $sql_id_utilisateur = $pdo->prepare("SELECT IdU FROM utilisateurs WHERE identifiant = :identifiant");
        $sql_id_utilisateur->bindParam(':identifiant', $identifiant_utilisateur);
        $sql_id_utilisateur->execute();
        $result_id_utilisateur = $sql_id_utilisateur->fetch(PDO::FETCH_ASSOC);

        // Si l'utilisateur est trouvé, récupérer son ID
        if ($result_id_utilisateur) {
            $id_utilisateur = $result_id_utilisateur['IdU'];

            // Vérifier si les paramètres nécessaires sont présents dans l'URL
            if (isset($_GET['action']) && $_GET['action'] == 'add_favorite' && isset($_GET['actualiteId'])) {
                // Récupérer l'ID de l'actualite à ajouter aux favoris
                $actualiteId = $_GET['actualiteId'];

                $actualiteId = intval($actualiteId);

                // Insérer les informations dans la table de favoris
                $sql_insert_favorite = $pdo->prepare("INSERT INTO favories_actualitées (IdU, IdA) VALUES (:id_utilisateur, :id_actualite)");
                $sql_insert_favorite->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
                $sql_insert_favorite->bindParam(':id_actualite', $actualiteId, PDO::PARAM_INT);
                $sql_insert_favorite->execute();

                // Réponse JSON pour indiquer que l'ajout a réussi
                echo json_encode(array("success" => true));
            } else {
                // Si les paramètres ne sont pas corrects, renvoyer une réponse JSON avec un message d'erreur
                echo json_encode(array("success" => false, "message" => "Paramètres manquants ou incorrects."));
            }
        } else {
            // Si l'utilisateur n'est pas trouvé dans la base de données, renvoyer une réponse JSON avec un message d'erreur
            echo json_encode(array("success" => false, "message" => "Utilisateur non trouvé."));
        }
    } catch (PDOException $e) {
        // En cas d'erreur, renvoyer une réponse JSON avec l'erreur
        echo json_encode(array("success" => false, "message" => "Erreur lors de l'ajout du favori : " . $e->getMessage()));
    }
} else {
    // Si l'utilisateur n'est pas connecté, renvoyer une réponse JSON avec un message d'erreur
    echo json_encode(array("success" => false, "message" => "Utilisateur non connecté."));
}
?>