<?php
include 'header.html';
if (isset($_POST['submitdetails'])) {

    try {

        $cname = $_POST['cname'];

        $caddress = $_POST['caddress'];

        if ($cname == '' or $caddress == '')

        {

            echo("You did not complete the insert form correctly <br> ");

        }else {

            $pdo = new PDO('mysql:host=localhost;dbname=videos; charset=utf8', 'root', '');

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO customers (NAME,ADDRESS, CUSTDATE) VALUES(:cname, :caddress, CURDATE())";

            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(':cname', $cname);

            $stmt->bindValue(':caddress', $caddress);

            $stmt->execute();

            header('location: add.php');
        }
    }

    catch (PDOException $e) {

        $title = 'An error has occurred';

        $output = 'Database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();

    }

}
include 'addform.html';

