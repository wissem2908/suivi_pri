<?php


include './config.php';

try {
    // Connection to the database
    $bdd = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));


    if (

        !isset($_POST['nom_sous_direction']) || empty($_POST['nom_sous_direction']) ||
        !isset($_POST['dir_form']) || empty($_POST['dir_form']) 
    ) {

        echo json_encode(array("response" => "false", "message" => "empty_field"));
    }
    else{
    $nom_sous_direction = $_POST['nom_sous_direction'];
    $dir_form = $_POST['dir_form'];
    $desc_sous_direction = $_POST['desc_sous_direction'];
  

// verify if sous dirction exist


    $req = $bdd->prepare('SELECT * FROM `sous_direction` where name =? and id_dir=? ');
    $res = $req->execute(array($nom_sous_direction,$dir_form));
    $count = $req->rowCount();

    if($count>0){
         echo json_encode(array("response" => "false", "message" => "sous_dirction_exist"));
    }else{

        $req = $bdd->prepare('INSERT INTO `sous_direction`(`name`, id_dir, `description`) VALUES(?,?,?)');
        $req->execute(array($nom_sous_direction,$dir_form,$desc_sous_direction));
          echo json_encode(array("response" => "true"));
    }







   
    }

} catch (Exception $e) {
    $msg = $e->getMessage();
    echo $msg;
}
