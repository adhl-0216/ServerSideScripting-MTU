<?php
setlocale(LC_ALL, "En_Us");

$balance = 100000;
$localeConv = localeconv();

while ($balance > 12000) {
    $balance*=1.05;
    $balance = round($balance,2);
    $balance-=12000;
    echo "<p>Balance:".$localeConv["currency_symbol"].number_format($balance, 2, $localeConv["mon_decimal_point"], $localeConv["mon_thousands_sep"])."</p>";
}

echo "<p>Balance:".$localeConv["currency_symbol"].number_format($balance, 2, $localeConv["mon_decimal_point"], $localeConv["mon_thousands_sep"]).". Unable to withdraw</p>";
