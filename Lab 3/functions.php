<title>Functions</title>
<?php

echo '<p>Subtract Numbers:</p>';
function subtractNumbers ($var1, $var2){
    return abs($var1-$var2);
}

echo '<p>'.subtractNumbers(rand(0,100),rand(0,100)).'</p><br>';

echo '<p>Calculate Pay :</p>';
function calcPay($hours, $hourlyRate) {
    $localeConv = localeconv();
    if ($hours > 60) {
        echo '<p> Hours are capped at 60.</p><br>';
        return null;
    }
    return '<p>'.$localeConv['currency_symbol'].number_format(($hours * $hourlyRate),2).'</p><br>';
}

echo calcPay(rand(1,100),10.5);

echo '<p>Squares and Cubes:</p>';
function squaresAndCubes ($X) {
    for ($i = 1; $i <= $X; $i++){
        echo '</p>'.($i).', '.($i**2).', '.($i**3).'</p>';
    }
}

squaresAndCubes(rand(1,10));
?>
