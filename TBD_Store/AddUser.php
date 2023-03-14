<?php
include "User.php";

if (isset($_POST['signUp'])){
    try {
        $pdo = new PDO('mysql:host=localhost; db_name=tbd_store; charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $newSignUp = new User($_POST['USER_EMAIL'], $_POST['USER_PASSWORD'], $_POST['USER_NAME']);
        $affected = $newSignUp->sqlInsert();
        if ($affected > 0){
            echo 'success. '.'<a href="User Log In.php">go to login</a>';
        }
    }catch (PDOException $ex) {
        echo $ex->getMessage().'; '.$ex->getTraceAsString();
    }
}
//$admin = new User('admin', 'admin@tbdstore.ie', 'a1b2c3d4');
//$admin->sqlInsert();