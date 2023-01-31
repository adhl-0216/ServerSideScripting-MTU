<?php
    $radius = $_GET['r'];
    $height = $_GET['h'];
    $volume = 0;

    function calCylinderVol($radius, $height, &$volume)
    {
        $volume = M_1_PI*($radius**2)*$height;
    }

    calCylinderVol($radius, $height, $volume);
    $volume = number_format($volume, 2);

echo "Volume of a cylinder with r=$radius and h=$height is $volume.";