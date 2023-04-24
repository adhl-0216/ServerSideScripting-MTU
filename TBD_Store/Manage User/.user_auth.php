<?php
session_start();
include "../.dbConnect.php";
function verify_login(&$user, $password): bool
{
    dbConnect($pdo);
    $sqlSelectByUsername = 'SELECT USER_PASSWORD, USER_NAME FROM tbd_store.users WHERE (USER_NAME=:user OR USER_EMAIL=:user)';
    $stmt = $pdo->prepare($sqlSelectByUsername);
    $stmt->bindValue(':user', $user);
    $stmt->execute();
    $row = $stmt->fetch();
    $user = $row['USER_NAME'];
    return password_verify($password, $row['USER_PASSWORD']);
}

if (isset($_POST)){
    $user = $_POST["username"];
    $psw = $_POST["password"];
    if (verify_login($user,$psw)){
        $_SESSION["username"] = $user;
        echo json_encode(array('isValid'=>true));
        return;
    }
    echo json_encode(array('isValid'=>false));
}









