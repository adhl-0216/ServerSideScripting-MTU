<?php
$powerOfTwo = 1;
$exponent = 0;
while($powerOfTwo < 1000) {
    $powerOfTwo*=2;
    $exponent++;
    echo "<p>2<sup>$exponent</sup> = $powerOfTwo</p>";
}

