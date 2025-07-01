<?php


include './config.php';

try {
    // Connection to the database
    $bdd = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

   
    $req = $bdd->prepare('SELECT *,direction.name as direction,employee.is_active as status FROM `employee` left join poste on employee.poste = poste.id_poste left join direction on employee.dir = direction.id_dir  left join sous_direction on employee.sous_dir  =  sous_direction.id_sous_direction  order by employee_id  desc');
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