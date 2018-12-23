<?php

function addNewCheck($evo, $data, $type, $payment, $discount, $amount)
{
    $mysqli = new mysqli("localhost", "u47513_rabbik", "Dtytnfhbq666", "u47513_wp30");
    if (mysqli_connect_errno()) {
        printf("Соединение не установлено: %s\n", mysqli_connect_error());
        exit();
    } else
    {
        echo 'Соединение установленно';
        $mysqli->close();
    }
    /*
    if($type == "SELL")
        $type = 1;
    else $type = 0;

    $data = parceDate($data);
    $mysqli->set_charset('utf8');
    $query = "INSERT INTO checks VALUES (NULL, '{$evo}', '{$data}' , {$type}, '{$payment}', {$discount}, {$amount})";
    $mysqli->query($query);

    $id = $mysqli->insert_id;
    $mysqli->close();
    $id = 0;
    if($type == "SELL")
        $type = 1;
    else $type = 0;
    $data = parceDate($data);
    echo "INSERT INTO checks VALUES (NULL, '{$evo}', '{$data}' , {$type}, '{$payment}', {$discount}, {$amount})";
    */
    //return $id;
}

function parceDate($evo_dat) {
    $arr_dat = explode("T", $evo_dat);
    $arr_dat[1] = explode(".", $arr_dat[1]);
    return $arr_dat[0] . " " . $arr_dat[1][0];
}

function addNewSell($id, $uuid, $name, $measure, $quantity, $price, $discount) {
    $mysqli = new mysqli("localhost", "u47513_rabbik", "Dtytnfhbq666", "u47513_wp30");
    if (mysqli_connect_errno()) {
        printf("Соединение не установлено: %s\n", mysqli_connect_error());
        exit();
    } else {
        echo 'Соединение установленно';
        $mysqli->close();
    }
    /*
    $mysqli->set_charset('utf8');
    $price = $price * 100;
    $discount = $discount * 100;
    $query = "INSERT INTO sells VALUES (NULL, {$id}, '{$uuid}' , '{$name}', '{$measure}', {$quantity}, {$price}, {$discount})";
    $mysqli->query($query);
    $mysqli->close();


    $price = $price * 100;
    $discount = $discount * 100;
    echo "INSERT INTO sells VALUES (NULL, {$id}, '{$uuid}' , '{$name}', '{$measure}', {$quantity}, {$price}, {$discount})";
    */
}

