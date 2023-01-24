<?php
$currentMonth = date('F');
//$currentMonth = "August";

switch ($currentMonth)
{
    case "August":
        echo "It's August, so it's really hot.";
        break;
    default:
        echo "Not August, it's $currentMonth so at least not in the peak of the heat.";
}