<?php
//dummy data
$user1 = new User();
$user1->setUsername('adhl_0216');
$user1->setPassword(password_hash('a1b2c3d4', PASSWORD_DEFAULT));
$user1->setEmail('adhl9000@gmail.com');
//dummy data
if (isset($_POST)){
    if ($_POST['username'] == $user1->username){
        if (password_hash($_POST['password'], PASSWORD_DEFAULT) != $user1->password){echo 'invalid password'; return;}
        echo 'valid credentials';
        return;
    }
}

