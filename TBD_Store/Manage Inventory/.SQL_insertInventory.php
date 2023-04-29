<?php
include "../.dbConnect.php";
try {
    dbConnect($pdo);
    if (isset($_POST['PRODUCT_NAME'])) {
        $sqlInsert = "INSERT INTO tbd_store.inventory (
                                 PRODUCT_TYPE, 
                                 PRODUCT_NAME, 
                                 PRODUCT_DESCRIPTION, 
                                 UK_SIZE, 
                                 PRICE, QUANTITY 
                                 ) VALUES (
                                           :prodType, 
                                           :prodName, 
                                           :prodDesc, 
                                           :ukSize, 
                                           :price, 
                                           :quantity
                                           )";
        $pStmt = $pdo->prepare($sqlInsert);
        $pStmt->bindValue(':prodType', $_POST['PRODUCT_TYPE']);
        $pStmt->bindValue(':prodName', $_POST['PRODUCT_NAME']);
        $pStmt->bindValue(':prodDesc', $_POST['PRODUCT_DESCRIPTION']);
        $pStmt->bindValue(':ukSize', $_POST['UK_SIZE']);
        $pStmt->bindValue(':price', $_POST['PRICE']);
        $pStmt->bindValue(':quantity', $_POST['QUANTITY']);
        $pStmt->execute();
        echo $pStmt->rowCount();
    }

    if (isset($_POST['prodImg'])){
        $sqlUpdate = "UPDATE tbd_store.inventory SET PRODUCT_IMG=:prodImg WHERE PRODUCT_NAME=:prodName";
        $stmt=$pdo->prepare($sqlUpdate);
        $stmt->bindValue(":prodImg", $_POST['prodImg']);
        $stmt->bindValue(':prodName', $_POST['prodName']);
        $stmt->execute();

        echo $stmt->rowCount();
    }

}
catch (PDOException $ex) {
    echo $ex;
}

