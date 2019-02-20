<?php


function parserProduct($data) {
    $data = trim($data, '[');
    $data = trim($data, ']');
    $data = trim($data, '}');
    $data = trim($data, '{');
    $arr = explode("},{", $data);
    $result = [];
    foreach ($arr as $value) {
        $result[] = selectProductData(explode(',', $value));
    }


    $parentList = getParentList($result);
    return getResultProductList($result, $parentList);

}

function getParentList($data) {
    $result = [];
    foreach ($data as $value) {
        if ($value['group'] == "true") {
            $result[$value['uuid']] = trim($value['name'], ' ');
            echo $value['uuid'] . " " . $value['name'] . "<br />";
        }
    }

    return $result;
}

function getResultProductList($data, $setParentList) {
    $result = [];

    foreach ($data as $value) {
        if ($value['group'] == "true")
            continue;
        $tmp = [];
        $arr = array("\n", "\r\n", "\r", "\"", "\\");
        $tmp['name'] = str_replace($arr, '', $value['name']);
        $tmp['parent'] = str_replace($arr, '', $setParentList[$value['parentUuid']]);
        $tmp['barCodes'] = str_replace($arr, '', $value['barCodes']);
        $tmp['description'] = str_replace($arr, '', $value['description']);
        $tmp['measureName'] = str_replace($arr, '', $value['measureName']);
        $tmp['uuid'] = str_replace($arr, '', $value['uuid']);
        $tmp['articleNumber'] = str_replace($arr, '', $value['articleNumber']);
        $tmp['price'] = $value['price'];
        $tmp['costPrice'] = $value['costPrice'];

        $result[] = $tmp;
    }

    return $result;
}

function selectProductData($data) {
    $result = [];
    foreach ($data as $value) {
        $tmp = explode(':', $value);
        if (count($tmp) > 1)
            $result[trim($tmp[0], '"')] = trim($tmp[1], '"');
        else
            $result[trim($tmp[0], '"')] = "";
    }

    return $result;
}

