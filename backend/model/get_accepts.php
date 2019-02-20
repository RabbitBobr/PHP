<?php
    function getAllAccepts() {
        $conn = json_decode(file_get_contents(__DIR__ . '/../resurses/bd_connect.json'), true);
        $mysqli = new mysqli($conn['localhost'], $conn['name'], $conn['pass'], $conn['bd_name']);
        if (mysqli_connect_errno()) {
            printf("Соединение не установлено: %s\n", mysqli_connect_error());
            exit();
        }
        $mysqli->set_charset('utf8');

        $result = [];

        $res = $mysqli->query("SELECT * FROM accepts");
        while ($row_accepts = $res->fetch_assoc()) {
            $res_products = $mysqli->query("SELECT * FROM products WHERE id = {$row_accepts['product_id']}");
            if($res_products->num_rows) {
                $product = $res_products->fetch_assoc();
                $costPrice = $row_accepts['costPrice'] / 100;
                $result[] = [
                    "name" => $product['name'],
                    "costPrice" => $costPrice,
                    "provider" => $row_accepts['provider'],
                    "quantity" => $row_accepts['quantity'],
                    "date" => explode(" ", $row_accepts['date'])[0]
                ];
            }
        }

        $mysqli->close();

        return $result;
    }