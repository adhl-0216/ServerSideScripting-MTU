
<?php
include "../.dbConnect.php";
session_start();
$totalSale = doubleval($_SESSION['subtotal']);
if (isset($_SESSION['checkOutItems'])){
    $checkOutItems = json_decode($_SESSION['checkOutItems'], true);
    dbConnect($pdo);
    $sqlInsert = "INSERT INTO tbd_store.sales ( USER_ID, SALE_DATE, TOTAL_SALE ) VALUES ( :userID, CURRENT_TIMESTAMP, :totalSale)";
    $stmt = $pdo->prepare($sqlInsert);
    $stmt->bindValue(":userID", $_SESSION['userID']);
    $stmt->bindValue(":totalSale", $totalSale);
    $stmt->execute();

    $sqlSelect = "SELECT LAST_INSERT_ID() FROM tbd_store.sales";
    $stmt = $pdo->prepare($sqlSelect);
    $stmt->execute();
    $row=$stmt->fetch();
    $saleId = $row['LAST_INSERT_ID()'];
    $keys = array_keys(json_decode($_SESSION['checkOutItems'], true));
    foreach ( $keys as $key){
        try {

            $sqlUpdate = "UPDATE tbd_store.inventory SET QUANTITY=QUANTITY-:quantity WHERE PRODUCT_ID=:prodID";
            $stmt = $pdo->prepare($sqlUpdate);
            $stmt->bindValue(":prodID", $key);
            $stmt->bindValue(":quantity", $checkOutItems[strval($key)]);
            $stmt->execute();


            $sqlSelect = "SELECT PRICE FROM tbd_store.inventory WHERE PRODUCT_ID=:prodID";
            $stmt = $pdo->prepare($sqlSelect);
            $stmt->bindValue(":prodID", $key);
            $stmt->execute();
            $row=$stmt->fetch();
            $price=$row['PRICE'];

            $sqlInsert = "INSERT INTO tbd_store.sales_items (SALE_ID, PRODUCT_ID, QUANTITY, COST) VALUES ( :saleID, :prodID, :quantity, :cost)";
            $stmt = $pdo->prepare($sqlInsert);
            $stmt->bindValue(":saleID", $saleId);
            $stmt->bindValue(":prodID", $key);
            $stmt->bindValue(":quantity", $checkOutItems[strval($key)]);
            $stmt->bindValue(":cost", $price*$checkOutItems[strval($key)]);
            $stmt->execute();



        }catch (PDOException $ex){
            $errMsg = $ex->getMessage().'; '.$ex->getTraceAsString();
            echo $errMsg;
        }
    }


}
?>


