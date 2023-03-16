<?php
    $pdo = new PDO("mysql:host=localhost;db_name=tbd_store;charset=utf8",'root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sqlSelectInventory = 'SELECT * FROM inventory';
    $resultSet = $pdo->prepare($sqlSelectInventory);
    while ($row=$resultSet->fetch()){

    }