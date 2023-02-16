<title>Savings</title>
<?php
$savings = 1000;
function calcInterest (&$savings, $interestRate = 0.2) {
    $savings*= (1 + $interestRate);
}
echo "<p>$savings</p>";
calcInterest($savings);
echo "<p>$savings</p>";
calcInterest($savings, 0.5);
echo "<p>$savings</p>";
calcInterest($savings);
echo "<p>$savings</p>";
?>
