<?php
session_start();
use TBD_Store\dbConnect;
$status = $_POST['sqlFunc'];
$_SESSION['status'] = $status;

function getConnection(): PDO
{
    $pdo = new PDO('mysql:host=localhost;db_name=tbd_store;charset=utf8','root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}
if ($status == "insert") insertInventory();
function insertInventory(){
    try {
        if (isset($_POST['data'])) {
            $product = $_POST['data'];
            $pdo = getConnection();
            $sqlInsert = 'INSERT INTO tbd_store.inventory (PRODUCT_TYPE, PRODUCT_NAME, PRODUCT_DESCRIPTION, UK_SIZE, PRICE, QUANTITY) VALUES (:prodType, :prodName, :prodDesc, :ukSize, :price, :quantity)';
            $pStmt = $pdo->prepare($sqlInsert);
            $pStmt->bindValue(':prodType', $product['PRODUCT_TYPE']);
            $pStmt->bindValue(':prodName', $product['PRODUCT_NAME']);
            $pStmt->bindValue(':prodDesc', $product['PRODUCT_DESCRIPTION']);
            $pStmt->bindValue(':ukSize', $product['UK_SIZE']);
            $pStmt->bindValue(':price', $product['PRICE']);
            $pStmt->bindValue(':quantity', $product['QUANTITY']);
            $pStmt->execute();
            echo $pStmt->rowCount();
        }
    }
    catch (PDOException $ex) {
        $errMsg = $ex->getMessage().'; '.$ex->getTraceAsString();
        echo $errMsg;
    }
}
if ($status == "select") selectInventory();
function selectInventory(){
    try {
        $pdo = getConnection();
        $sqlSelectInventory = 'SELECT * FROM tbd_store.inventory';
        $pStmt = $pdo->prepare($sqlSelectInventory);
        $pStmt->execute();
        $result = $pStmt;
        $inventory = array();
        while ($row=$result->fetch()){
            $product = array(
                'PRODUCT_ID'=>$row['PRODUCT_ID'],
                'PRODUCT_NAME'=>$row['PRODUCT_NAME'],
                'PRODUCT_DESCRIPTION'=>$row['PRODUCT_DESCRIPTION'],
                'UK_SIZE'=>$row['UK_SIZE'],
                'PRICE'=>$row['PRICE'],
                'QUANTITY'=>$row['QUANTITY'],
            );
            $inventory[] = $product;
        }
        if ($result->rowCount() > 0) echo json_encode($inventory);
        else echo "N/A";
    }
    catch (PDOException $ex) {
        $errMsg = $ex->getMessage().'; '.$ex->getTraceAsString();
        echo $errMsg;
    }
}


/**
 * @throws ErrorException
 */
function deleteInventory()
{
    try {
        if (isset($_POST['data'])) {
            $prodID = $_POST['data'];
            $pdo = getConnection();
            $sqlDeleteInv = 'DELETE FROM tbd_store.inventory WHERE PRODUCT_ID=:prodID';
            $pStmt = $pdo->prepare($sqlDeleteInv);
            $pStmt->bindValue(':prodID', $prodID);
            $pStmt->execute();
            echo $pStmt->rowCount();
        }
    }
    catch (PDOException $ex) {
        $errMsg = $ex->getMessage().'; '.$ex->getTraceAsString();
        throw new ErrorException("Delete failed".$errMsg);
    }
}

if ($status == "delete") try {
    deleteInventory();
} catch (ErrorException $e) {
}

function updateInventory()
{
    try {
        if (isset($_POST['data'])) {
            $data = $_POST['data'];
            var_dump($data);
            $pdo = getConnection();
            $sqlUpdateInv = 'UPDATE tbd_store.inventory SET PRODUCT_NAME=:prodName, PRODUCT_DESCRIPTION=:prodDesc, PRICE=:price, QUANTITY=:quantity WHERE PRODUCT_ID=:prodID';
            $pStmt = $pdo->prepare($sqlUpdateInv);
            $pStmt->bindValue(':prodName', $data['prodName']);
            $pStmt->bindValue(':prodDesc', $data['prodDesc']);
            $pStmt->bindValue(':price', $data['price']);
            $pStmt->bindValue(':quantity', $data['quantity']);
            $pStmt->bindValue(':prodID', $data['prodID']);
            $pStmt->execute();
            echo $pStmt->rowCount();
        }
    }
    catch (PDOException $ex) {
        $errMsg = $ex->getMessage().'; '.$ex->getTraceAsString();
        echo $errMsg;
//        throw new ErrorException("Delete failed".$errMsg);
    }
}

if ($status == "update") updateInventory();



