<?php
//function calcWage($hour, $rate){
//    if ($hour > 60) return "Maximum working hour is 60! Employee's wage is &euro;".(60*$rate);
//    return "Employee's wage is &euro;".($hour*$rate);
//}

include("../Lab 5/mainFunc.php");

echo "<p>".calcWage($_GET['hour'], $_GET['rate'])."</p>";