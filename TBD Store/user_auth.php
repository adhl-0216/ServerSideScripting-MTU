<?php
include ".User.php";
//dummy data
$user1 = new User();
$user1->setUsername('adhl_0216');
$user1->setPassword(password_hash('aaaa', "2y"));
$user1->setEmail('adhl9000@gmail.com');
//dummy data

if (isset($_POST)){
    if ($_POST['username'] == $user1->username || $_POST['username'] == $user1->email){
        if (!password_verify($_POST['password'], $user1->password)){
            echo json_encode(array('validCred'=>false));
            return;
        }
        echo json_encode(array('validCred'=>true));
        return;
    }
}



