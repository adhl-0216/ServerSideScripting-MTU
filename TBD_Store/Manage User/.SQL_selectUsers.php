<?php
include '../.dbConnect.php';
if (isset($_POST['username'])){
    $username = $_POST['username'];
    try {
        dbConnect($pdo);

        $sqlSelect = 'SELECT * FROM tbd_store.users WHERE USER_NAME=:username';
        $stmt = $pdo->prepare($sqlSelect);
        $stmt->bindValue(':username', $username);
        $stmt->execute();
        $result = $stmt;
        $row = $result->fetch();
        $userInfo = array(
            'username'=>$row['USER_NAME'],
            'userEmail'=>$row['USER_EMAIL'],
            'userPsw'=>$row['USER_PASSWORD'],
            'regDate'=>$row['REGISTRATION_DATE'],
        );
        echo json_encode($userInfo);
    }
    catch (PDOException $ex){

    }
}
