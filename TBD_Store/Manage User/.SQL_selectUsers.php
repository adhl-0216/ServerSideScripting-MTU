<?php
include '../.dbConnect.php';
if (isset($_POST['userID'])){
    $userID = $_POST['userID'];
    try {
        dbConnect($pdo);

        $sqlSelect = 'SELECT * FROM tbd_store.users WHERE USER_ID=:userID';
        $stmt = $pdo->prepare($sqlSelect);
        $stmt->bindValue(':userID', $userID);
        $stmt->execute();
        $result = $stmt;
        $row = $result->fetch();
        $userInfo = array(
            'fName'=>$row['FIRST_NAME'],
            'lName'=>$row['LAST_NAME'],
            'userEmail'=>$row['USER_EMAIL'],
            'userPsw'=>$row['USER_PASSWORD'],
            'regDate'=>$row['REGISTRATION_DATE'],
        );
        echo json_encode($userInfo);
    }
    catch (PDOException $ex){

    }
}
