<?php
session_start();
include "User.php";
if (isset($_POST)){
    $user = $_POST['username'];
    $psw = $_POST['password'];
    if (User::verify_login($user,$psw)){
        echo json_encode(array('isValid'=>true));
        $_SESSION["username"] = $user;
        return;
    }
    echo json_encode(array('isValid'=>false));
}









