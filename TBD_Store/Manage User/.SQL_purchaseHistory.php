<?php
include "../.dbConnect.php";
session_start();
if (isset($_POST['sale'])) {
    try {
        dbConnect($pdo);
        $sqlSelect = "SELECT * FROM tbd_store.sales s WHERE s.USER_ID=:userID";
        $stmt = $pdo->prepare($sqlSelect);
        $stmt->bindValue(":userID", $_SESSION['userID']);
        $stmt->execute();

        $purchaseHistory = array();
        while ($row = $stmt->fetch()) {
            $purchase = array(
                "saleID" => $row['SALE_ID'],
                "saleDate" => $row['SALE_DATE'],
                "totalSale" => $row['TOTAL_SALE']
            );
            $purchaseHistory[] = $purchase;
        }
        echo json_encode($purchaseHistory);
    } catch (PDOException $ex) {

    }
}

if (isset($_POST['saleId'])) {
    $saleId = $_POST['saleId'];

    try {
        dbConnect($pdo);
        $sqlSelect = "SELECT s.PRODUCT_ID AS PRODUCT_ID, PRODUCT_NAME AS PRODUCT_NAME, s.QUANTITY AS QUANTITY FROM (tbd_store.sales_items s LEFT JOIN tbd_store.inventory i on s.PRODUCT_ID = i.PRODUCT_ID) WHERE s.SALE_ID=:saleId";
        $stmt = $pdo->prepare($sqlSelect);
        $stmt->bindValue(":saleId", $saleId);
        $stmt->execute();

        $purchaseDetails = array();
        while ($row = $stmt->fetch()) {
            $product = array(
                "prodID" => $row['PRODUCT_ID'],
                "prodName" => $row['PRODUCT_NAME'],
                "quantity" => $row['QUANTITY'],
            );
            $purchaseDetails[] = $product;
        }
        echo json_encode($purchaseDetails);
    } catch (PDOException $ex) {

    }
}