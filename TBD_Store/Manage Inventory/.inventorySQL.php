<?php
//session_start();
include "../.dbConnect.php";
$status = $_POST['sqlFunc'];
//$_SESSION['status'] = $status;
dbConnect($pdo);

if ($status == "update") updateInventory();
if ($status == "select") selectInventory();
if ($status == "delete") deleteInventory();

function selectInventory(){
    global $pdo;

    try {
        $sqlSelectInventory = 'SELECT * FROM tbd_store.inventory';
        $pStmt = $pdo->prepare($sqlSelectInventory);
        $pStmt->execute();
        $result = $pStmt;
        $inventory = array();
        while ($row=$result->fetch()){
            $product = array(
                'PRODUCT_TYPE'=>$row['PRODUCT_TYPE'],
                'PRODUCT_ID'=>$row['PRODUCT_ID'],
                'PRODUCT_NAME'=>$row['PRODUCT_NAME'],
                'PRODUCT_DESCRIPTION'=>$row['PRODUCT_DESCRIPTION'],
                'UK_SIZE'=>$row['UK_SIZE'],
                'PRICE'=>$row['PRICE'],
                'QUANTITY'=>$row['QUANTITY'],
                'PRODUCT_IMG'=>$row['PRODUCT_IMG'],
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
function deleteInventory()
{
    global $pdo;

    try {
        if (isset($_POST['data'])) {
            $prodID = $_POST['data'];
            $sqlDeleteInv = 'DELETE FROM tbd_store.inventory WHERE PRODUCT_ID=:prodID';
            $pStmt = $pdo->prepare($sqlDeleteInv);
            $pStmt->bindValue(':prodID', $prodID);
            $pStmt->execute();
            echo $pStmt->rowCount();
        }
    }
    catch (PDOException $ex) {
        $errMsg = $ex->getMessage().'; '.$ex->getTraceAsString();
        echo $errMsg;
    }
}
function updateInventory()
{
    global $pdo;

    try {
        if (isset($_POST['data'])) {
            $data = $_POST['data'];
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
    }
}