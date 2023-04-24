<?php
session_start();
include "../.dbConnect.php";

$userID = $_SESSION['userID'];

if (isset($_POST['userEmail'])) {

    $fName = $_POST['firstName'];
    $lName = $_POST['lastName'];
    $userEmail = $_POST['userEmail'];

    dbConnect($pdo);
    $sqlUpdate = "UPDATE tbd_store.users SET FIRST_NAME=:fName, LAST_NAME=:lName, USER_EMAIL=:userEmail WHERE USER_ID=:userID";
    $stmt = $pdo->prepare($sqlUpdate);
    $stmt->bindValue(":fName", $fName);
    $stmt->bindValue(":lName", $lName);
    $stmt->bindValue(":userEmail", $userEmail);
    $stmt->bindValue(":userID", $userID);

    $stmt->execute();
    echo "success";
    return;
}

if (isset($_POST['cfmPassword'])){

    $password = $_POST['password'];

    dbConnect($pdo);
    $sqlUpdatePsw = 'UPDATE tbd_store.users SET USER_PASSWORD = :password WHERE USER_ID = :userID';
    $stmt = $pdo->prepare($sqlUpdatePsw);
    $stmt->bindValue(":password", password_hash($password, "2y"));
    $stmt->bindValue(":userID", $userID);

    $stmt->execute();
    echo "success";
    return;
}


