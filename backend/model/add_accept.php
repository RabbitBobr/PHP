<?php

    function addAccept($accept, $number) {
        $conn = json_decode(file_get_contents(__DIR__ . '/../resurses/bd_connect.json'), true);
        $mysqli = new mysqli($conn['localhost'], $conn['name'], $conn['pass'], $conn['bd_name']);
        if (mysqli_connect_errno()) {
            printf("Соединение не установлено: %s\n", mysqli_connect_error());
            exit();
        }
        $mysqli->set_charset('utf8');
        $res_num = $mysqli->query("SELECT * FROM accepts WHERE provider = {$number}");
    if (!$res_num->num_rows){
        foreach ($accept as $value) {
            if ($value['type'] === "REGISTER_POSITION") {
                $res = $mysqli->query("SELECT id, quantity FROM products WHERE uuid = '{$value['commodityUuid']}'");
                if (!$res->num_rows) {
                    include __DIR__ . "/../controllers/getProducsForAccept.php";
                    $res = $mysqli->query("SELECT id, quantity FROM products WHERE uuid = '{$value['commodityUuid']}'");
                    if (!$res->num_rows) {
                        file_put_contents("log.txt","Товар {$value['commodityName']} в базе отсутствует\n", FILE_APPEND | LOCK_EX);
                    }
                }
                
                $arr = $res->fetch_assoc();
                    $id = $arr['id'];
                    $costPrice = $value['price'] * 100;
                    $date = explode('T', $value['creationDate'])[0];
                    $quantity = $value['quantity'];
                    $mysqli->query("INSERT INTO accepts VALUE (NULL, {$id}, {$costPrice}, '{$date}', {$number}, {$quantity})");
                    $sum_quantity = $quantity + $arr['quantity'];
                    $mysqli->query("UPDATE products SET quantity = {$sum_quantity} WHERE id = {$id}");
            }
        }
    }
        $mysqli->close();
    }