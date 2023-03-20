<?php
    $pdo = new PDO("mysql:host=localhost;db_name=tbd_store;charset=utf8",'root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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