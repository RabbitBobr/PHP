<?php
 require_once "controllers/parse_product.php";

 $data = file_get_contents('php://input');
 
$data = trim($data, '[');
$data = trim($data, ']');



//$data = file_get_contents('data.txt');

file_put_contents("data.txt", $data);

//$json_data = json_decode($data, true);


//if ($json_data['group'] === false)
//echo $data;
    newProduct($data);
//else
  //  newGroup($json_data);

 http_response_code(200);
