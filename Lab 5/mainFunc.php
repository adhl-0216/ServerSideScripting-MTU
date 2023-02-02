<?php
function calCylinderVol($radius, $height, &$volume)
{
    $volume = M_1_PI*($radius**2)*$height;
}

function calcWage($hour, $rate){
    if ($hour > 60) return "Maximum working hour is 60! Employee's wage is &euro;".(60*$rate);
    return "Employee's wage is &euro;".($hour*$rate);
}

function euroToSterling($euro) {
    return $euro*0.88;
}

function generateStars($numOfStars) {
    $stars = '';
    for ($i = 0; $i < $numOfStars; $i++){
        $stars.=str_repeat('*',$i+1);
        $stars.='<br>';
    }
    return $stars;
}
