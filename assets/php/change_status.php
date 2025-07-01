<?php


include './config.php';

try {
    // Connection to the database
    $bdd = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

   


    $id_employee = $_POST['id_employee'];
    $action = $_POST['action'];

    if($action=="deactive"){
    $req = $bdd->prepare('UPDATE `employee` SET `is_active` =0 where employee_id=?');
    $res = $req->execute(array($id_employee));



    }

    if($action=="active"){
    $req = $bdd->prepare('UPDATE `employee` SET `is_active` =1 where employee_id=?');
    $res = $req->execute(array($id_employee));



    }


 



} catch (Exception $e) {
    $msg = $e->getMessage();
    echo $msg;
}