<?php

    function save_check($data) {
    require __DIR__ . "/../model/add_data.php";
        $data = json_decode($data, true);
        $id = addNewCheck($data['id'], $data['data']['dateTime'], $data['data']['type'], $data['data']['paymentSource'],
 $data['data']['totalDiscount'], $data['data']['totalAmount']);

foreach ($data['data']['items'] as $value) {
    if ($value['name'] !== "Позиция по свободной цене") {
        addNewSell($id, $value['id'], $value['name'], $value['measureName'], $value['quantity'], $value['price'], $value['discount']);
        
    }
}
    
    }