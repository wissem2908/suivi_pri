<?php


include './config.php';

try {
    // Connection to the database
    $bdd = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $ids = $_POST['id_dir'] ?? [];

    if (empty($ids)) {
        echo json_encode([]);
        exit;
    }

    // Create placeholders (?, ?, ?...)
    $placeholders = implode(',', array_fill(0, count($ids), '?'));

    $req = $bdd->prepare("SELECT * FROM `sous_direction` WHERE id_dir IN ($placeholders)");
    $req->execute($ids);


    $output = [];
    while ($res = $req->fetch(PDO::FETCH_ASSOC)) {
        $output[] = $res;
    } //fin while
    echo json_encode($output);
 



} catch (Exception $e) {
    $msg = $e->getMessage();
    echo $msg;
}