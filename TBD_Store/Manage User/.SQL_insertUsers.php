<?php
include "../.dbConnect.php";
if (isset($_POST)){
    try {
        dbConnect($pdo);

        $email = $_POST['USER_EMAIL'];
        $password = $_POST['USER_PASSWORD'];
        $fName = $_POST['FIRST_NAME'];
        $lName = $_POST['LAST_NAME'];

        $sqlInsert = 'INSERT INTO users (
                   FIRST_NAME, LAST_NAME, USER_EMAIL, USER_PASSWORD, REGISTRATION_DATE
                   )
                VALUES (
                :fName, :lName, :email, :password, CURRENT_TIMESTAMP
                )';
        $stmt = $pdo->prepare($sqlInsert);
        $stmt->bindValue(':fName', $fName);
        $stmt->bindValue(':lName', $lName);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', password_hash($password,'2y'));

        $stmt->execute();
        $affected = $stmt->rowCount();

        if ($affected > 0){
            echo 'success';
        }
    }catch (PDOException $ex) {
        echo $ex->getMessage().'; '.$ex->getTraceAsString();
    }
}