<?php


include './config.php';

try {
    // Connection to the database
    $bdd = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));


    if (

        !isset($_POST['nom']) || empty($_POST['nom']) ||
        !isset($_POST['prenom']) || empty($_POST['prenom']) ||
        // !isset($_POST['email']) || empty($_POST['email']) ||
        !isset($_POST['dir']) || empty($_POST['dir']) ||
        !isset($_POST['sous_dir']) || empty($_POST['sous_dir']) ||
        !isset($_POST['fonction']) || empty($_POST['fonction'])
    ) {

        echo json_encode(array("response" => "false", "message" => "empty_field"));
    }
    else{
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $dir = $_POST['dir'];
    $sous_dir = $_POST['sous_dir'];
    $fonction = $_POST['fonction'];

// verify if employee exist


    $req = $bdd->prepare('SELECT * FROM `employee` where nom =? and prenom = ? ');
    $res = $req->execute(array($nom,$prenom));
    $count = $req->rowCount();

    if($count>0){
         echo json_encode(array("response" => "false", "message" => "employee_exist"));
    }else{

        $req = $bdd->prepare('INSERT INTO `employee`( `nom`, `prenom`, `email`, `dir`, `sous_dir`, `poste` ) VALUES(?,?,?,?,?,?)');
        $req->execute(array($nom,$prenom,$email,$dir,$sous_dir,$fonction));
          echo json_encode(array("response" => "true"));
    }







   
    }

} catch (Exception $e) {
    $msg = $e->getMessage();
    echo $msg;
}
