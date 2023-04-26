<?php
session_start();
if(isset($_SESSION['userID'])) echo $_SESSION['userID'];
else echo "N/A";

if(isset($_POST['signOut'])){
    session_destroy();
    header("Location: ../Homepage/index.php");
}