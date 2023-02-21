<?php
include "User.php";
//dummy data
$user1 = new User();
$user1->setUsername('adhl_0216');
$user1->setPassword(password_hash('a1b2c3d4', "2y"));
$user1->setEmail('adhl9000@gmail.com');
var_dump($user1);
//dummy data

if (isset($_POST['submit'])){
    if ($_POST['username'] == $user1->username || $_POST['username'] == $user1->email){
        if (!password_verify($_POST['password'], $user1->password)){echo 'invalid password'; return;}
        echo 'valid credentials<br>';
        return;
    }
}

