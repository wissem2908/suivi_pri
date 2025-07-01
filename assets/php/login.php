<?php


include './config.php';

try {
    // Connection to the database
    $bdd = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    if (!isset($_POST['username']) || empty($_POST['username'])  || !isset($_POST['password']) || empty($_POST['password'])) {

        die(json_encode(array("response" => "false", "message" => "empty_field")));
    }


    $username = $_POST['username'];
    $password = $_POST['password'];

    $password = sha1($password);
    // verify if user exist


    $req = $bdd->prepare('SELECT * FROM `users` left join employee on users.employee_id  = employee.employee_id   where username =?  and password = ?  ');
    $res = $req->execute(array($username, $password));
    $count = $req->rowCount();

    if ($count == 0) {
        echo json_encode(array("response" => "false", "message" => "user_not_found"));
    } else {


        $result = $req->fetch(PDO::FETCH_ASSOC);
        $user_id  = $result['user_id'];
        // Assuming login is successful and you have $user_id
        $updateLogin = $bdd->prepare("UPDATE users SET last_login = NOW() WHERE user_id  = :id");
        $updateLogin->execute(['id' => $user_id]);

        session_start();
        $_SESSION['is_login']='true';
        $_SESSION['username']=$result['username'];
        $_SESSION['user_id']=$result['user_id'];
        $_SESSION['role']=$result['role'];
        $_SESSION['direction']=$result['dir'];

        echo json_encode(array("response" => "true"));
    }
} catch (Exception $e) {
    $msg = $e->getMessage();
    echo $msg;
}
