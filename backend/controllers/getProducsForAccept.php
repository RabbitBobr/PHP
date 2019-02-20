<?php
        $opts = array(
    'http' => array(
        'method' => "GET",
        'header' => "X-Authorization: 0fcb357d-9b1e-4646-a123-b4c42b7758f4",
        'Content-Type' => "application/json"
    ));
$context = stream_context_create($opts);
$data = file_get_contents('http://api.evotor.ru/api/v1/inventories/stores/search', false, $context);

$result = explode(",",$data);
$uuid_arr = explode(":", $result[0]);
$uuid = trim($uuid_arr[1], '"');

$data = file_get_contents("https://api.evotor.ru/api/v1/inventories/stores/{$uuid}/products", false, $context);

include_once __DIR__ . "/../controllers/parserProduct.php";
include_once __DIR__ . "/../model/save_product.php";


$products_type = parserProduct($data);

addGroup($products_type);

