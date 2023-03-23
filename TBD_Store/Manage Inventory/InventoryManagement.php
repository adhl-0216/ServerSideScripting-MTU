<?php
session_start();
include "../header.html";
include ".InventoryManagement.html";
include "../footer.html";
$status = $_SESSION['status'];
echo $status;