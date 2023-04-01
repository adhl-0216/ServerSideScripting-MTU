<?php
session_start();
include ".user.php";

$process = $_POST['process'];
$data = $_POST['data'];
switch ($process){
    case "signUp":
        signUp($data);
        break;
    case "terminate":
        terminateAccount($data);
        break;
    case "signIn":
        signIn($data);
        break;
    default:
        break;
}
function signUp($data){
    $affected = User::sqlInsert($data['USER_EMAIL'], $data['USER_PASSWORD'], $data['USER_NAME']);
    if ($affected > 0){
        echo 'success. '. '<a href="Sign In.html">go to login</a>';
    }
}

function terminateAccount($data)
{
    $affected = User::sqlDelete($data['username']);
}

function signIn($data)
{
    $user = $data['username'];
    $psw = $data['password'];
    if (User::verify_login($user, $psw)) {
        echo json_encode(array('isValid' => true));
        $_SESSION["username"] = $user;
        return;
    }
    echo json_encode(array('isValid' => false));
}


