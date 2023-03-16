<?php
session_start();

echo $_SESSION["username"];
echo '<br>';
echo $_SESSION["colour"];

session_destroy();