<?php

include_once __DIR__ . "/save_group_product.php";
include_once __DIR__ . "/add_product.php";

function addGroup($productList) {
    $groupList = getGroupName($productList);
    $groupList = saveGroup($groupList);
    saveProductToBD($productList, $groupList);


}

function getGroupName($productList) {
    $result = [];
    $result[] = $productList[0]['parent'];
    for ($i = 1; $i<count($productList); $i++) {
        if (array_search($productList[$i]['parent'], $result) === false)
            $result[] = $productList[$i]['parent'];
    }

    return $result;
}