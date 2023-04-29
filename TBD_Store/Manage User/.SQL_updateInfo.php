<?php
include "../.dbConnect.php";
session_start();
$userID=$_SESSION['userID'];

try {
    if (isset($_POST)) {
        dbConnect($pdo);

        $sqlCount = "SELECT COUNT(*) FROM tbd_store.user_info WHERE USER_ID=:userID";
        $stmt = $pdo->prepare($sqlCount);
        $stmt->bindValue(":userID", $userID);
        $stmt->execute();
        $count = $stmt->fetch()[0];

        if ($count > 0) {
            $sqlUpdate = "UPDATE tbd_store.user_info SET 
                               FIRST_NAME=:fName, 
                               LAST_NAME=:lName, 
                               ADDRESS=:addr, 
                               ZIPCODE=:zipcode, 
                               CITY=:city, 
                               STATE=:state,
                               COUNTRY=:country, 
                               NAME_ON_CARD=:cardName, 
                               CARD_NUMBER=:cardNum,
                               CARD_EXPIRATION_DATE=:cardExp
                               WHERE USER_ID=:userID";

            $stmt = $pdo->prepare($sqlUpdate);
            $stmt->bindValue(":fName", $_POST['firstname']);
            $stmt->bindValue(":lName", $_POST['lastname']);
            $stmt->bindValue(":addr", $_POST['address']);
            $stmt->bindValue(":zipcode", $_POST['zipcode']);
            $stmt->bindValue(":city", $_POST['city']);
            $stmt->bindValue(":state", $_POST['state']);
            $stmt->bindValue(":country", $_POST['country']);
            $stmt->bindValue(":cardName", $_POST['cardName']);
            $stmt->bindValue(":cardNum", $_POST['cardNumber']);
            $stmt->bindValue(":cardExp", $_POST['expirationDate']);

            $stmt->bindValue(":userID", $userID);
            $stmt->execute();
        }
        else {
            $sqlInsert = "INSERT INTO tbd_store.user_info VALUES( :userID,
                               :fName, 
                               :lName, 
                               :addr, 
                               :zipcode, 
                               :city, 
                               :state,
                               :country, 
                               :cardName, 
                               :cardNum,
                               :cardExp)";

            $istmt = $pdo->prepare($sqlInsert);
            $istmt->bindValue(":userID", $userID);
            $istmt->bindValue(":fName", $_POST['firstname']);
            $istmt->bindValue(":lName", $_POST['lastname']);
            $istmt->bindValue(":addr", $_POST['address']);
            $istmt->bindValue(":zipcode", $_POST['zipcode']);
            $istmt->bindValue(":city", $_POST['city']);
            $istmt->bindValue(":state", $_POST['state']);
            $istmt->bindValue(":country", $_POST['country']);
            $istmt->bindValue(":cardName", $_POST['cardName']);
            $istmt->bindValue(":cardNum", $_POST['cardNumber']);
            $istmt->bindValue(":cardExp", $_POST['expirationDate']);

            $istmt->execute();
        }

        echo $stmt->rowCount();
    }
}
catch (PDOException $ex){
    echo $ex;
}