<?php
include("css.inc");

$brush_price = 5; 
$counter = 10;

echo ("<table>");
echo ("<tr><td><h1>Quantity</h1></td>");
echo ("<td><h1>Price</h1></td></tr>");
while ( $counter <= 100 ) {
   echo ("<tr><td>");
   echo ($counter);
   echo ("</td><td>");
   echo ($brush_price * $counter);
   echo ("</td></tr>");
   $counter = $counter + 10;
}
echo ("</table>");

?>

</body>

</html>
