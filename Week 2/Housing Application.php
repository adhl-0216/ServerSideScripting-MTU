<?php
$cost = 300;

switch ($cost)
{
    case ($cost < 33.64):
        $allowance = 0;
        break;
    case ($cost > 252):
        $allowance = 201.60;
        break;
    default:
        $allowance = $cost*.08;
}

echo "The cost is &euro;{$cost} and your allowance is &euro;{$allowance}";