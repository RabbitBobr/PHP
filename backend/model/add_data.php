<?php

function addNewCheck($evo, $data, $type, $payment, $discount, $amount)
{
    $conn = json_decode(file_get_contents(__DIR__ . '/../resurses/bd_connect.json'), true);
    $mysqli = new mysqli($conn['localhost'], $conn['name'], $conn['pass'], $conn['bd_name']);
    if (mysqli_connect_errno()) {
        printf("Соединение не установлено: %s\n", mysqli_connect_error());
        exit();
    }
    if($type == "SELL")
        $type = 1;
    else $type = 0;

    $data = parceDate($data);
    $mysqli->set_charset('utf8');
    $query = "INSERT INTO checks VALUES (NULL, '{$evo}', '{$data}' , {$type}, '{$payment}', {$discount}, {$amount})";
    $mysqli->query($query);

    $id = $mysqli->insert_id;
    $mysqli->close();

    return $id;
}

function parceDate($evo_dat) {
    $arr_dat = explode("T", $evo_dat);
    $arr_dat[1] = explode(".", $arr_dat[1]);
    return $arr_dat[0] . " " . $arr_dat[1][0];
}

function addNewSell($id, $uuid, $name, $measure, $quantity, $price, $discount) {
    $conn = json_decode(file_get_contents(__DIR__ . '/../resurses/bd_connect.json'), true);
    $mysqli = new mysqli($conn['localhost'], $conn['name'], $conn['pass'], $conn['bd_name']);
    if (mysqli_connect_errno()) {
        printf("Соединение не установлено: %s\n", mysqli_connect_error());
        exit();
    }
    $mysqli->set_charset('utf8');
    $price = $price * 100;
    $discount = $discount * 100;
    $res = $mysqli->query("SELECT id, quantity FROM products WHERE uuid = '{$uuid}'");
    if ($res->num_rows) {
        $arr = $res->fetch_assoc();
        $product_id = $arr['id'];
        $product_quantity = $arr['quantity'];
        $query = "INSERT INTO sells VALUES (NULL, {$id}, '{$product_id}' , '{$name}', '{$measure}', {$quantity}, {$price}, {$discount})";
        $mysqli->query($query);
        $product_quantity -= $quantity;
        $mysqli->query("UPDATE products SET quantity = {$product_quantity} WHERE id = {$product_id}");
    }
    $mysqli->close();
}

