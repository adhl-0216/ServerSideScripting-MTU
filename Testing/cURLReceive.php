<?php
//if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//    $data = json_decode(file_get_contents('php://input'), true);
//    $the_file = fopen("thefile.json", 'wb') or die("Unable to open file!");
//    try {
//        fwrite($the_file, json_encode($data, JSON_THROW_ON_ERROR));
//    } catch (JsonException $e) {
//    }
//    fclose($the_file);
//    echo "success";
//} else {
//    echo "fail";
//}

$json = file_get_contents('php://input');
$data = json_decode($json, true);
echo $data;