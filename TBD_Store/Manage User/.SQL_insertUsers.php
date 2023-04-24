<?php
include "../.dbConnect.php";
if (isset($_POST)){
    try {
        dbConnect($pdo);

        $email = $_POST['USER_EMAIL'];
        $password = $_POST['USER_PASSWORD'];
        $username = $_POST['USER_NAME'];
        $fName = $_POST['FIRST_NAME'];
        $lName = $_POST['LAST_NAME'];

        $sqlInsert = 'INSERT INTO users VALUES (
                :email, :password, :username, CURRENT_TIMESTAMP, :fName, :lName
                )';
        $stmt = $pdo->prepare($sqlInsert);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', password_hash($password,'2y'));
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':fName', $username);
        $stmt->bindValue(':lName', $username);
        $stmt->execute();
        $affected = $stmt->rowCount();

        if ($affected > 0){
            echo 'success';
        }
    }catch (PDOException $ex) {
        echo $ex->getMessage().'; '.$ex->getTraceAsString();
    }
}