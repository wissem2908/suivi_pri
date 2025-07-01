<?php


include './config.php';

try {
    // Connection to the database
    $bdd = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));


    if (

        !isset($_POST['nom_prenom']) || empty($_POST['nom_prenom']) ||
        !isset($_POST['username']) || empty($_POST['username']) ||
        !isset($_POST['password']) || empty($_POST['password']) ||
        !isset($_POST['role']) || empty($_POST['role']) 
    ) {

        echo json_encode(array("response" => "false", "message" => "empty_field"));
    }
    else{
    $nom_prenom = $_POST['nom_prenom'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];



    $hashed_pass = sha1($password);
// verify if user exist


    $req = $bdd->prepare('SELECT * FROM `users` where username =?  ');
    $res = $req->execute(array($username));
    $count = $req->rowCount();

    if($count>0){
         echo json_encode(array("response" => "false", "message" => "user_exist"));
    }else{

        $req = $bdd->prepare('INSERT INTO `users`(`employee_id`, `username`, `password`, `role`) VALUES(?,?,?,?)');
        $req->execute(array($nom_prenom,$username,$hashed_pass,$role,));
          echo json_encode(array("response" => "true"));
    }







   
    }

} catch (Exception $e) {
    $msg = $e->getMessage();
    echo $msg;
}
