<?php
session_start();
$productType = $_POST['productType'];

function getConnection(): PDO
{
    $pdo = new PDO('mysql:host=localhost;db_name=tbd_store;charset=utf8','root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}

try {
    $pdo = getConnection();
    $sqlSelect = 'SELECT * FROM tbd_store.inventory WHERE PRODUCT_TYPE=:prodType';
    $stmt = $pdo->prepare($sqlSelect);
    $stmt->bindValue(':prodType', $productType);
    $stmt->execute();
    $result = $stmt;
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

}catch (PDOException $ex) {
    $errMsg = $ex->getMessage().'; '.$ex->getTraceAsString();
    echo $errMsg;
}