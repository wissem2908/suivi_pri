<?php


include './config.php';

try {
    // Connection to the database
    $bdd = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

   


    $id_user = $_POST['id_user'];
    $action = $_POST['action'];

    if($action=="deactive"){
    $req = $bdd->prepare('UPDATE `users` SET `is_active` =0 where user_id =?');
    $res = $req->execute(array($id_user));



    }

    if($action=="active"){
    $req = $bdd->prepare('UPDATE `users` SET `is_active` =1 where user_id =?');
    $res = $req->execute(array($id_user));



    }


 



} catch (Exception $e) {
    $msg = $e->getMessage();
    echo $msg;
}