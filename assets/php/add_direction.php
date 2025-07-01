<?php


include './config.php';

try {
    // Connection to the database
    $bdd = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));


    if (

        !isset($_POST['nom_direction']) || empty($_POST['nom_direction'])
    ) {

        echo json_encode(array("response" => "false", "message" => "empty_field"));
    }
    else{
    $nom_direction = $_POST['nom_direction'];
    $desc_direction = $_POST['desc_direction'];
  

// verify if dirction exist


    $req = $bdd->prepare('SELECT * FROM `direction` where name =? ');
    $res = $req->execute(array($nom_direction));
    $count = $req->rowCount();

    if($count>0){
         echo json_encode(array("response" => "false", "message" => "dirction_exist"));
    }else{

        $req = $bdd->prepare('INSERT INTO `direction`(`name`, `description`) VALUES(?,?)');
        $req->execute(array($nom_direction,$desc_direction));
          echo json_encode(array("response" => "true"));
    }







   
    }

} catch (Exception $e) {
    $msg = $e->getMessage();
    echo $msg;
}
