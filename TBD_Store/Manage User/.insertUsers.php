<?php
include ".user.php";

if (isset($_POST['signUp'])){
    try {
        $pdo = new PDO('mysql:host=localhost; db_name=tbd_store; charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $affected = User::sqlInsert($_POST['USER_EMAIL'], $_POST['USER_PASSWORD'], $_POST['USER_NAME']);
        if ($affected > 0){
            echo 'Great success. '. '<a href="signIn.php">go to login</a>';
        }
    }catch (PDOException $ex) {
        echo $ex->getMessage().'; '.$ex->getTraceAsString();
    }
}
//$admin = new User('admin', 'admin@tbdstore.ie', 'a1b2c3d4');
//$admin->sqlInsert();