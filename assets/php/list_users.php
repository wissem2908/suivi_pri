<?php


include './config.php';

try {
    // Connection to the database
    $bdd = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

   
    $req = $bdd->prepare('SELECT *, users.is_active as status FROM `users` left join employee on users.employee_id  = employee.employee_id    order by user_id  desc');
    $res = $req->execute();


    $output = [];
    while ($res = $req->fetch(PDO::FETCH_ASSOC)) {
        $output[] = $res;
    } //fin while
    echo json_encode($output);
 



} catch (Exception $e) {
    $msg = $e->getMessage();
    echo $msg;
}