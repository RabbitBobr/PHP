<?php
    function addWrightOff($transactions, $number) {
        $conn = json_decode(file_get_contents(__DIR__ . '/../resurses/bd_connect.json'), true);
        $mysqli = new mysqli($conn['localhost'], $conn['name'], $conn['pass'], $conn['bd_name']);
        if (mysqli_connect_errno()) {
            printf("Соединение не установлено: %s\n", mysqli_connect_error());
            exit();
        }
        $mysqli->set_charset('utf8');
        $res_wf = $mysqli->query("SELECT * FROM wright_off WHERE number = {$number}");
    if(!$res_wf->num_rows) {
        foreach ($transactions as $value) {
            if ($value['type'] === "REGISTER_POSITION") {
                $res = $mysqli->query("SELECT id, quantity FROM products WHERE uuid = '{$value['commodityUuid']}'");
                if (!$res->num_rows) {
                    include __DIR__ . "../controllers/getProducsForAccept.php";
                    $res = $mysqli->query("SELECT id, quantity FROM products WHERE uuid = '{$value['commodityUuid']}'");
                    if (!$res->num_rows) {
                        file_put_contents("log.txt", "Товар {$value['commodityName']} в базе отсутствует\n", FILE_APPEND | LOCK_EX);
                    }
                }

                $arr = $res->fetch_assoc();
                $id = $arr['id'];
                $costPrice = $value['costPrice'] * 100;
                $date = date(explode('T', $value['creationDate'])[0]);
                $quantity = $value['quantity'];
                $mysqli->query("INSERT INTO wright_off VALUE (NULL, {$id}, {$costPrice}, '{$date}', {$quantity}, {$number})");
            
                $sum_quantity = $arr['quantity'] - $quantity;
                $mysqli->query("UPDATE products SET quantity = {$sum_quantity} WHERE id = {$id}");
            }
        }
    }
        $mysqli->close();
    }