<?php
include "../.dbConnect.php";
dbConnect($pdo);
if (isset($_POST['prodID'])){
    try {
        $sqlSelect = "SELECT * FROM tbd_store.inventory WHERE PRODUCT_ID=:prodID";
        $stmt = $pdo->prepare($sqlSelect);
        $stmt->bindValue(":prodID", $_POST['prodID']);
        $stmt->execute();

        if($row=$stmt->fetch()){
            $prodDetails = array(
                'prodType' => $row['PRODUCT_TYPE'],
                'prodName'=>$row['PRODUCT_NAME'],
                'prodDesc'=>$row['PRODUCT_DESCRIPTION'],
                'ukSize'=>$row['UK_SIZE'],
                'price'=>$row['PRICE'],
            );

            echo json_encode($prodDetails);
            return;
        }
    }catch (PDOException $ex){
        echo $ex->getMessage().$ex->getTraceAsString();
    }
}