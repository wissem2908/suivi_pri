<?php


include './config.php';

try {
    // Connection to the database
    $bdd = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));


    if (

        !isset($_POST['nom_fonction']) || empty($_POST['nom_fonction'])
    ) {

        echo json_encode(array("response" => "false", "message" => "empty_field"));
    }
    else{
    $nom_fonction = $_POST['nom_fonction'];
    $desc_fonction = $_POST['desc_fonction'];
  

// verify if dirction exist


    $req = $bdd->prepare('SELECT * FROM `poste` where name =? ');
    $res = $req->execute(array($nom_fonction));
    $count = $req->rowCount();

    if($count>0){
         echo json_encode(array("response" => "false", "message" => "fonction_exist"));
    }else{

        $req = $bdd->prepare('INSERT INTO `poste`(`name`, `description`) VALUES(?,?)');
        $req->execute(array($nom_fonction,$desc_fonction));
          echo json_encode(array("response" => "true"));
    }







   
    }

} catch (Exception $e) {
    $msg = $e->getMessage();
    echo $msg;
}
