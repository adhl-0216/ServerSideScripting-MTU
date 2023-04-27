<?php
include "../.dbConnect.php";
session_start();
if (isset($_POST['address'])){
    try {
        dbConnect($pdo);
        $sqlInsert = "INSERT INTO tbd_store.user_info VALUES (:userID, :addr, :zipcode, :city, :state, :country, :nameOnCard, :cardNumber, :expirationDate)";
        $stmt = $pdo->prepare($sqlInsert);
        $stmt->bindValue(":userID", $_SESSION['userID']);
        $stmt->bindValue(":addr", $_POST['address']);
        $stmt->bindValue(":zipcode", $_POST['zipcode']);
        $stmt->bindValue(":city", $_POST['city']);
        $stmt->bindValue(":state", $_POST['state']);
        $stmt->bindValue(":country", $_POST['country']);
        $stmt->bindValue(":nameOnCard", $_POST['name']);
        $stmt->bindValue(":cardNumber", $_POST['cardNumber']);
        $stmt->bindValue(":expirationDate", $_POST['expirationDate']);

        $stmt->execute();
        echo $stmt->rowCount();
    }catch (PDOException $ex){
        echo "err";
    }
}
