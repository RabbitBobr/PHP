<?php
    function newProduct($data) {
        include_once __DIR__ . "/../model/add_product.php";
        $data = json_decode($data, true);
        
        $product = [];
        $product['name'] = trimString($data['name']);
        $product['parent'] = $data['parentUuid'];
        if ($data['barCodes'] === null || count($data['barCodes']) == 0)
                $product['barCodes'] = "0";
            else {
                $product['barCodes'] = $data['barCodes'][0];
            }
            if($data['description']===null)
                $product['description'] = "";
            else
                $product['description'] = trimString($data['description']);
        $product['measureName'] = $data['measureName'];
        $product['uuid'] = $data['uuid'];
        $product['articleNumber'] = trimString($data['articleNumber']);
        
        saveProductToBD($product);
        
    }
    
    function newGroup($data) {
        require __DIR__ . "/../model/add_group.php";
        save_new_group($data['name'], $data['uuid']);
    }
    
    function trimString($str) {
        $arr = array("\n", "\r\n", "\r", "\"", "\\");
        $str = str_replace($arr, '', $str);
        return $str;
    }