<?php
session_start();
include "../.dbConnect.php";
if (isset($_POST['deleteUser'])) {
    try {
        dbConnect($pdo);

        $sqlDelete = 'DELETE FROM users WHERE USER_NAME=:username';
        $result = $pdo->prepare($sqlDelete);
        $result->bindValue(':username',$_SESSION['username']);
        $result->execute();

        if ($result->rowCount() > 0) {
            echo 'success';
        }else{
            echo 'failure';
        }
    }catch (PDOException $ex) {
        echo $ex->getMessage().'; '.$ex->getTraceAsString();
    }
}