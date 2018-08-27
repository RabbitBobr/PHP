<?php
require_once __DIR__ . "/../model/category_model.php";
function getCategory($type){


$array_set = [];
$array_category = getArrayAllCategory();

foreach ($array_category as $value)
{

    if ($value['product_type'] == $type)
        $array_set[] = $value['category'];

}
 return $array_set;
}






