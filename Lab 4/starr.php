<?php
function generateStars($numOfStars) {
    $stars = '';
    for ($i = 0; $i < $numOfStars; $i++){
        $stars.=str_repeat('*',$i+1);
        $stars.='<br>';
    }
    return $stars;
}

echo generateStars($_GET['numOfStars']);
