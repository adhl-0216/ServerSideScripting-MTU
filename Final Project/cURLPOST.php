<input type="button" value="redirect" onclick="window.location.href ='cURLReceive.php'">
<?php
$url = 'Final Project/cURLReceive.php';
$json = '{
    "sender":"user1",
    "receiver":"user2",
    "message":"hello"
}';

$crl = curl_init($url);
curl_setopt($crl, CURLOPT_POST, 1);
curl_setopt($crl, CURLOPT_POSTFIELDS, $json);
curl_setopt($crl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);

$result = curl_exec($crl);
echo $result;
?>