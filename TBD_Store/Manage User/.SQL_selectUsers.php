<?php
include '../.dbConnect.php';
$userID = $_POST['userID'];
dbConnect($pdo);

if (isset($_POST['oldPassword'])){
    try {
        $sqlSelect="SELECT USER_PASSWORD FROM tbd_store.users WHERE USER_ID=:userID";
        $stmt = $pdo->prepare($sqlSelect);
        $stmt->bindValue(":userID", $userID);
        $stmt->execute();
        if ($row=$stmt->fetch()){
            echo (password_verify($_POST['oldPassword'], $row['USER_PASSWORD'])) ? "valid" : "invalid";
        }
        return;
    }catch (PDOException $ex){

    }
}

if (isset($_POST['userID'])){
    try {

        $sqlSelect = 'SELECT * FROM tbd_store.users WHERE USER_ID=:userID';
        $stmt = $pdo->prepare($sqlSelect);
        $stmt->bindValue(':userID', $userID);
        $stmt->execute();
        $result = $stmt;
        $row = $result->fetch();
        $userInfo = array(
            'fName'=>$row['FIRST_NAME'],
            'lName'=>$row['LAST_NAME'],
            'userEmail'=>$row['USER_EMAIL'],
            'userPsw'=>$row['USER_PASSWORD'],
            'regDate'=>$row['REGISTRATION_DATE'],
        );
        echo json_encode($userInfo);
        return;
    }
    catch (PDOException $ex){

    }
}


