<?php
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    include __DIR__ . "/../model/category_model.php";

    $set_category = [];
    if($_POST['type'] == 'clothes')
        $set_category = getArrayCategoryByType("Одежда");
    else if ($_POST['type'] == 'toys')
        $set_category = getArrayCategoryByType('Игрушки');
    else if ($_POST['type'] == 'stationery')
        $set_category = getArrayCategoryByType('Канцелярские товары');
    else
        return;

    $return_string = '';

    foreach ($set_category as $value)
    {
        $return_string .= '<option value="' . $value['id'] . '">' . $value['category'] . '</option>';
    }

    echo $return_string;
}