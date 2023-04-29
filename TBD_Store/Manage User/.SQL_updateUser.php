<?php
session_start();
include "../.dbConnect.php";

$userID = $_SESSION['userID'];

if (isset($_POST['userEmail'])) {

    $userEmail = $_POST['userEmail'];

    dbConnect($pdo);
    $sqlUpdate = "UPDATE tbd_store.users SET USER_EMAIL=:userEmail WHERE USER_ID=:userID";
    $stmt = $pdo->prepare($sqlUpdate);
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


