<?php
session_start();
$stack = $_SESSION['prodIDArr'] ?? array();

if(isset($_POST['prodID'])){
    $stack[] = $_POST['prodID'];
}

$_SESSION['prodIDArr'] = $stack;

echo json_encode($_SESSION['prodIDArr']);
