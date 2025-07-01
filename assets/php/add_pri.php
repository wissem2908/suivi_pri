<?php


 include './config.php';


  try {
        // Connection to the database
        $bdd = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

  $period = $month_year = date('m-Y');


  //verify if pri of this month exist:

    $req = $bdd->prepare('select * from pri where period = ?');
    $req->execute(array($period));

    $count = $req->rowCount();
    if($count>0){
        echo json_encode(array('response'=>'false', 'message'=>'pri_exist'));

    }else{




        //archiver les pri du mois passé



        /*********************************************************** */


        $req1 = $bdd->prepare('UPDATE `pri` SET is_active= 0 ');
        $req1->execute();


        /************************************************************ */
  $req3 = $bdd->prepare('SELECT * FROM `employee` where is_active =1');
  $res = $req3->execute();



    while ($res = $req3->fetch(PDO::FETCH_ASSOC)) {
        $id_employee = $res['employee_id'];


               $req2 = $bdd->prepare('INSERT INTO `pri`(`id_employee`, `period`, `respect_objectif`, `qualite_travail`, `organisation`, `disponibilite`) VALUES (?,?,?,?,?,?) ');
               $res = $req2->execute(array($id_employee,$month_year,0,0,0,0));

                

        
    } //fin while

      echo json_encode(array('response'=>'true'));

    }




    } catch (Exception $e) {
        $msg = $e->getMessage();
        echo $msg;
    }



