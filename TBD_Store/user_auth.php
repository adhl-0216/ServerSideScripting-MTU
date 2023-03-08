<?php
include ".User.php";

if (isset($_POST)){
    if (User::verify_password($_POST['username'],$_POST['username'],$_POST['password'])){
        echo json_encode(array('validCred'=>true));
        return;
    }
    echo json_encode(array('validCred'=>false));
    return;
}





