<?php
header('Content-Type: application/json');
session_start();
$response = ['success' => false];

if (isset($_SESSION['autoriser']) && $_SESSION['autoriser'] == "oui") {
    require_once 'BDD.php';
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['id']) && isset($data['category'])) {
        $id = $data['id'];
        $category = $data['category'];
        
        try {
            $pdo->beginTransaction();
            switch ($category) {
                case 'Actualités':
                    $stmt = $pdo->prepare('DELETE FROM favories_actualitées WHERE IdFA = ?');
                    break;
                case 'Guides':
                    $stmt = $pdo->prepare('DELETE FROM favories_guides WHERE IdFG = ?');
                    break;
                case 'Critiques':
                    $stmt = $pdo->prepare('DELETE FROM favories_critiques WHERE IdFC = ?');
                    break;
                default:
                    throw new Exception('Catégorie invalide');
            }

            if ($stmt->execute([$id])) {
                $pdo->commit();
                $response['success'] = true;
            } else {
                $pdo->rollBack();
            }
        } catch (Exception $e) {
            $pdo->rollBack();
            $response['error'] = $e->getMessage();
        }
    }
}

echo json_encode($response);
?>