<?php
session_start();
include "../.dbConnect.php";
function verify_login(&$user, $password): bool
{
    dbConnect($pdo);
    $sqlSelect = 'SELECT USER_ID, USER_PASSWORD, USER_EMAIL FROM tbd_store.users WHERE USER_EMAIL=:user';
    $stmt = $pdo->prepare($sqlSelect);
    $stmt->bindValue(':user', $user);
    $stmt->execute();
    $row = $stmt->fetch();
    $user = $row['USER_ID'];
    $psw = $row['USER_PASSWORD'];
    return password_verify($password, $psw);
}

if (isset($_POST)){
    $user = $_POST["userEmail"];
    $psw = $_POST["password"];

    if (verify_login($user,$psw)){
        $_SESSION['userID'] = $user;
        echo json_encode(array('isValid'=>true));
        return;
    }

    echo json_encode(array('isValid'=>false));
}









