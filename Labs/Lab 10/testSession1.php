<?php
session_start();
$_SESSION["username"] = 'name';
$_SESSION["colour"] = 'blue';
echo 'values stored. ';
echo '<a href="testSession2.php">redirect</a>';
