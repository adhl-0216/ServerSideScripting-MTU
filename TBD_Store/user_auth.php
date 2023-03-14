<?php
include "User.php";
if (isset($_POST['login'])){
    $username = $_POST['username'];

    if (User::verify_login($username,$username,$_POST['password'])){
        echo json_encode(array('validCred'=>true));
        session_start();
        $_SESSION['var'] = $username;
        return;
    }
    echo json_encode(array('validCred'=>false));
    return;
}









