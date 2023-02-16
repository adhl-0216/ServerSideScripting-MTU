<?php

//function euroToSterling($euro) {
//    return $euro*0.88;
//}

include("../Lab 5/mainFunc.php");

echo 'Pound Sterling (£): '.euroToSterling($_GET['euro']);
