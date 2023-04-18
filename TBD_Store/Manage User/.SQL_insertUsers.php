<?php
include "../.dbConnect.php";
if (isset($_POST)){
    try {
        dbConnect($pdo);

        $email = $_POST['USER_EMAIL'];
        $password = $_POST['USER_PASSWORD'];
        $username = $_POST['USER_NAME'];

        $sqlInsert = 'INSERT INTO users (
               USER_EMAIL, USER_PASSWORD, USER_NAME, REGISTRATION_DATE
               ) VALUES (
                :email, :password, :username, CURRENT_TIMESTAMP
                )';
        $stmt = $pdo->prepare($sqlInsert);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', password_hash($password,'2y'));
        $stmt->bindValue(':username', $username);
        $stmt->execute();
        $affected = $stmt->rowCount();

        if ($affected > 0){
            echo 'success';
        }
    }catch (PDOException $ex) {
        echo $ex->getMessage().'; '.$ex->getTraceAsString();
    }
}
//$admin = new User('admin', 'admin@tbdstore.ie', 'a1b2c3d4');
