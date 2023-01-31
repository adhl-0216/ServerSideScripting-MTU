<title>Product Price Ranges</title>
<h1>Product Price Ranges</h1>
<?php
$product_name = "Video cards";

switch ($product_name)
{
    case "Video cards":
        echo  "Video cards range from €50 to €500";
        break;
    case "LCD monitors":
        echo "LCD monitors range from €200 to €400";
        break;
    case "Intel processors":
        echo "Intel processors range from €100 to €1000";
        break;
    default:
        echo "Otherwise - Sorry, we don't carry this product";
}
?>