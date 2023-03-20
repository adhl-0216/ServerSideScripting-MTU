<?php
try {
    $pdo = new PDO('mysql:host=localhost;db_name=tbd_store;charset=utf8','root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sqlInsert = 'INSERT INTO tbd_store.inventory VALUES (:prodID, :prodName, :prodDesc, :price, :quantity)';
    $affected = $pdo->prepare($sqlInsert);
    $affected->bindValue(':prodID', $_POST['PRODUCT_ID']);
    $affected->bindValue(':prodName', $_POST['PRODUCT_NAME']);
    $affected->bindValue(':prodDesc', $_POST['PRODUCT_DESCRIPTION']);
    $affected->bindValue(':price', $_POST['PRICE']);
    $affected->bindValue(':quantity', $_POST['QUANTITY']);
    $affected->execute();
}
catch (PDOException $ex) {
    echo $ex->getMessage().'; '.$ex->getTraceAsString();
}


