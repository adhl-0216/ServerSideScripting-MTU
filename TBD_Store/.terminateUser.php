<?php
if (isset($_POST['terminateUser'])) {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=tbd_store;charset=utf8','root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sqlDelete = 'DELETE FROM users WHERE USER_NAME=:username';
        $result = $pdo->prepare($sqlDelete);
        $result->bindValue(':username',$_POST['userID']);
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