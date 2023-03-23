<?php
session_start();
$_SESSION['status'] = $_POST['sqlFunc'];
function getConnection(): PDO
{
    $pdo = new PDO("mysql:host=localhost;db_name=tbd_store;charset=utf8",'root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}
function insertInventory(){
    try {
        if (isset($_POST['data'])) {
            $json = json_decode($_POST['data']);
            $pdo = getConnection();
            $sqlInsert = 'INSERT INTO tbd_store.inventory VALUES (:prodID, :prodName, :prodDesc, :price, :quantity)';
            $affected = $pdo->prepare($sqlInsert);
            $affected->bindValue(':prodID', $json['PRODUCT_ID']);
            $affected->bindValue(':prodName', $json['PRODUCT_NAME']);
            $affected->bindValue(':prodDesc', $json['PRODUCT_DESCRIPTION']);
            $affected->bindValue(':price', $json['PRICE']);
            $affected->bindValue(':quantity', $json['QUANTITY']);
            $affected->execute();
            echo true;
        }
    }
    catch (PDOException $ex) {
        echo false;
//    echo $ex->getMessage().'; '.$ex->getTraceAsString();
    }
}

function selectInventory(){
    try {
        $pdo = getConnection();
        $sqlSelectInventory = 'SELECT * FROM tbd_store.inventory';
        $resultSet = $pdo->prepare($sqlSelectInventory);
        $resultSet->execute();
        $inventory = array(array());
        $idx = 0;
        while ($row=$resultSet->fetch()){
            $inventory[$idx][0] = $row['PRODUCT_ID'];
            $inventory[$idx][1] = $row['PRODUCT_NAME'];
            $inventory[$idx][2] = $row['DESCRIPTION'];
            $inventory[$idx][3] = $row['PRICE'];
            $inventory[$idx][4] = $row['QUANTITY'];
            $idx++;
        }

        echo json_encode($inventory);
    }
    catch (PDOException $ex) {
        echo false;
//    echo $ex->getMessage().'; '.$ex->getTraceAsString();
    }

//    echo $_POST['sqlFunc'];

        switch ($_POST['sqlFunc']) {
            case "select":
                selectInventory();
                break;
            case "insert":
                insertInventory();
                break;
            default:
                break;
        }
}