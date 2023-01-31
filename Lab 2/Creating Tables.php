<style>
     table, td, th{
        border: 1px solid black;
    }
</style>

<?php
$n = 0;

echo "<table><th>n</th><th>n<sup>2</sup></th><th>n<sup>3</sup></th>";
while ($n <= 100) {
    $sq = $n**2;
    $cb = $n**3;
    echo "<tr><td>$n</td><td>$sq</td><td>$cb</td></tr>";
    $n++;
}
