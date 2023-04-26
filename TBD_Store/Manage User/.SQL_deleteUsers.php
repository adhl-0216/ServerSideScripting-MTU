<?php
session_start();
include "../.dbConnect.php";
if (isset($_POST['deleteUser'])) {
    try {
        dbConnect($pdo);

        $sqlDelete = 'DELETE FROM users WHERE USER_ID=:userID';
        $stmt = $pdo->prepare($sqlDelete);
        $stmt->bindValue(':userID',$_SESSION['userID']);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo 100;
        }else{
            echo 500;
        }
    }catch (PDOException $ex) {
        echo 500;
        echo $ex->getMessage().'; '.$ex->getTraceAsString();
    }
}