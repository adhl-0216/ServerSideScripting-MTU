<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=videos;charset=utf8','root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo $pdo->getAttribute(PDO::ATTR_CONNECTION_STATUS).'<br>';
    echo $pdo->getAttribute(PDO::ATTR_SERVER_INFO).'<br>';

    $sqlSelect = 'SELECT * FROM customers WHERE NAME = :cname';
    $result = $pdo->prepare($sqlSelect);
    $result->bindValue(':cname', $_POST['custname']);
//    $result->bindValue(':cname', 'Adrian');
    $result->execute();
    while ($row = $result->fetch()){
        printf('%s; %s; %s; %s <br>',$row['custid'],$row['NAME'],$row['ADDRESS'],$row['CUSTDATE']);
    }
}catch (PDOException $e){
    echo 'Unable to connect to database. '.$e;
}