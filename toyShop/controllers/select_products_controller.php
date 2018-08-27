<?php
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    include __DIR__ . "/../model/product_model.php";
    include __DIR__ . "/../model/category_model.php";

    $array_products = selectAllProducts();
    $array_category = getArrayAllCategory();

    echo '
<table>
<caption>Список товаров</caption>
<tr>
    <th>Наименование товара</th>
    <th>Артикул</th>
    <th>Категория</th>
    <th>Рекомендованная цена</th>
    <th>Количество</th>
</tr>';
    foreach ($array_products as $value)
    {

        echo '<tr>
<td>'.$value['name'].'</td>
<td>'. $value['vendore_code'] .'</td>
<td>'. getCategory($array_category, $value['id']) .'</td>
<td>'. $value['recomend_price']/100 .'</td>
<td>'.$value['size'].'</td>
        </tr>';

    };
    echo '

</table>';
}

function getCategory($array, $id)
{
    foreach ($array as $value)
    {
        if ($value['id'] == $id)
            return $value['category'];
    }
    return '';
}
