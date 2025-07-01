<?php
include './config.php';
header('Content-Type: application/json');

// Required fields
$required_fields = ['id_pri', 'respect_objectif', 'qualite_travail', 'organisation', 'disponibilite', 'total'];

foreach ($required_fields as $field) {
    if (!isset($_POST[$field]) || $_POST[$field] === '') {
        echo json_encode([
            'response' => 'false',
            'message' => "missing_or_empty: $field"
        ]);
        exit;
    }
}

$id_pri = (int) $_POST['id_pri'];
$respect_objectif = floatval($_POST['respect_objectif']);
$qualite_travail = floatval($_POST['qualite_travail']);
$organisation = floatval($_POST['organisation']);
$disponibilite = floatval($_POST['disponibilite']);
$total = floatval($_POST['total']);

try {
    $bdd = new PDO(
        "mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=utf8",
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    $stmt = $bdd->prepare("
        UPDATE pri SET 
            respect_objectif = ?, 
            qualite_travail = ?, 
            organisation = ?, 
            disponibilite = ?, 
            total = ?
        WHERE id_pri = ?
    ");

    $success = $stmt->execute([
        $respect_objectif,
        $qualite_travail,
        $organisation,
        $disponibilite,
        $total,
        $id_pri
    ]);

    if ($success) {
        echo json_encode([
            'response' => true,
            'message' => 'updated',
            'id_pri' => $id_pri
        ]);
    } else {
        echo json_encode([
            'response' => 'false',
            'message' => 'update_failed'
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        'response' => 'false',
        'message' => 'error: ' . $e->getMessage()
    ]);
}
