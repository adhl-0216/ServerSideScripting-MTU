<?php
    $radius = (int)$_GET['r'];
    $height = (int)$_GET['h'];
    $volume = 0.0;

//    function calCylinderVol($radius, $height, &$volume)
//    {
//        $volume = M_1_PI*($radius**2)*$height;
//    }

    include("../Lab 5/mainFunc.php");

    calCylinderVol($radius, $height, $volume);
    $volume = number_format($volume, 2);

echo "Volume of a cylinder with r=$radius and h=$height is $volume.";