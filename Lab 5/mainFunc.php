<?php
declare(strict_types=1);

function calCylinderVol(int $radius, int $height, float &$volume)
{
    $volume = M_1_PI*($radius**2)*$height;
}

function calcWage(int $hour, float $rate): string
{
    if ($hour > 60) return "Maximum working hour is 60! Employee's wage is &euro;".(60*$rate);
    return "Employee's wage is &euro;".($hour*$rate);
}

function euroToSterling(float $euro) : float
{
    return (float)number_format(($euro*0.88),2);
}

function generateStars(int $numOfStars) : string
{
    $stars = '';
    for ($i = 0; $i < $numOfStars; $i++){
        $stars.=str_repeat('*',$i+1);
        $stars.='<br>';
    }
    return $stars;
}
