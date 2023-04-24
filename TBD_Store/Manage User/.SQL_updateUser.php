<?php
session_start();
include "../.dbConnect.php";
//    $userDetails = $_POST['userDetails'];
    $fName = $_POST['firstName'];
    $lName = $_POST['lastName'];
    $userEmail = $_POST['userEmail'];
    $userID = $_SESSION['userID'];
    echo "here";
    dbConnect($pdo);
    $sqlUpdate = "UPDATE tbd_store.users SET FIRST_NAME=:fName, LAST_NAME=:lName, USER_EMAIL=:userEmail WHERE USER_ID=:userID";
    $stmt = $pdo->prepare($sqlUpdate);
    $stmt->bindValue(":fName", $fName);
    $stmt->bindValue(":lName", $lName);
    $stmt->bindValue(":userEmail", $userEmail);
    $stmt->bindValue(":userID", $userID);

    $stmt->execute();


