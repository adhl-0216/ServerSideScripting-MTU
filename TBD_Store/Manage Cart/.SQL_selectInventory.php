<?php
include "../.dbConnect.php";
dbConnect($pdo);
if (isset($_POST['prodID'])){
    $json = json_decode($_POST['prodID']);
    $allProducts = array();
    foreach ($json as $prodID) {

        try {
            $sqlSelect = "SELECT * FROM tbd_store.inventory WHERE PRODUCT_ID=:prodID";
            $stmt = $pdo->prepare($sqlSelect);
            $stmt->bindValue(":prodID", substr($prodID,2));
            $stmt->execute();

            while($row=$stmt->fetch()){
                $prodDetails = array(
                    'prodID' => $row['PRODUCT_ID'],
                    'prodType' => $row['PRODUCT_TYPE'],
                    'prodName'=>$row['PRODUCT_NAME'],
                    'prodDesc'=>$row['PRODUCT_DESCRIPTION'],
                    'ukSize'=>$row['UK_SIZE'],
                    'price'=>$row['PRICE'],
                    'prodImg'=>$row['PRODUCT_IMG'],
                );
                $allProducts[] = $prodDetails;
//                echo json_encode($prodDetails);
            }
        }catch (PDOException $ex){
            echo $ex->getMessage().$ex->getTraceAsString();
        }

    }

    echo json_encode($allProducts);
}