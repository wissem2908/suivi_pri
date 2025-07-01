<?php


include './config.php';

try {
    // Connection to the database
    $bdd = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

  
    $req = $bdd->prepare('DELETE FROM `employee` WHERE  employee_id =?  ');
    $res = $req->execute(array($_POST['id_employee']));



    echo 'true';
 



} catch (Exception $e) {
    $msg = $e->getMessage();
    echo $msg;
}