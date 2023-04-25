<?php
session_start();
if(isset($_SESSION['userID'])) echo $_SESSION['userID'];
else echo "N/A";