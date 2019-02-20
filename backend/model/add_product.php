<?php

function saveProductToBD($productList, $groupList) {
    $conn = json_decode(file_get_contents(__DIR__ . '/../resurses/bd_connect.json'), true);
    $mysqli = new mysqli($conn['localhost'], $conn['name'], $conn['pass'], $conn['bd_name']);
    if (mysqli_connect_errno()) {
        printf("Соединение не установлено: %s\n", mysqli_connect_error());
        exit();
    }
    $mysqli->set_charset('utf8');
    $resultSet = [];

// Перебираем массив с товарамии в кассе
    foreach ($productList as $value) {
        // Преобразуем данные о цнах на товар
    $costPrice = $value['costPrice'] * 100;
    $price = $value['price'] * 100;
        //Ищем в списке товаров - продук с таким же uuid
        $result = $mysqli->query("SELECT * FROM products WHERE uuid = '{$value['uuid']}'");
        // Если такого товара нет
        if(!$result->num_rows) {
            $id = $groupList[$value['parent']];
            if ($value['barCodes'] == "[]")
                $barCode =  "0";
            else {
                $barCode = trim($value['barCodes'], '[');
                $barCode = trim($barCode, "]");
                $barCode = trim($barCode, '"');
            }
            // Сохраняем его в БД
            $query = "INSERT INTO products VALUES (NULL, {$id}, '{$value['uuid']}', '{$value['name']}' , '{$barCode}',
                      '{$value['articleNumber']}', '{$value['measureName']}', '{$value['description']}', 0)";
            $res = $mysqli->query($query);
            
            $res = $mysqli->query("INSERT INTO price VALUE (NULL, {$mysqli->insert_id}, {$costPrice}, {$price})");
        // Если такой товар есть
        } else {
            $tmp = $result->fetch_assoc();
            if($value['name'] !== $tmp['name'])
                //Проверяем не изменилось ли название
                $mysqli->query("UPDATE products SET name='{$value['name']}' WHERE id = {$tmp['id']}");
            if($value['description'] !== $tmp['discription'])
                //Проверяем не изменилось ли описание
                $mysqli->query("UPDATE products SET discription='{$value['description']}' WHERE id = {$tmp['id']}");
                
            //Ищем данные о стоимости в БД
            $res_price = $mysqli->query("SELECT cost_price, price FROM price WHERE product_id = {$tmp['id']}");
            // Если данных нет, вносим их
            
            if(!$res_price->num_rows){
               $mysqli->query("INSERT INTO price VALUE (NULL, {$tmp['id']}, {$costPrice}, {$price})");
            //Если данные есть
            } else {
                $tmp_p = $res_price->fetch_assoc();
                if (!$tmp_p['cost_price'] === "" . $costPrice)
                    $mysqli->query("INSERT INTO price VALUE (NULL, {$tmp['id']}, {$costPrice}, {$price})");
            }
        }
    }
    $mysqli->close();
}