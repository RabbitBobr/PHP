<?php
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    include __DIR__ . "/../model/sales_model.php";

    $array_sales = selectAllSales();

    echo '
<table>
<caption>Список закупок</caption>
<tr>
    <th>Наименование товара</th>
    <th>Номер чека</th>
    <th>Дата</th>
    <th>Стоимость</th>
</tr>';
    foreach ($array_sales as $value)
    {
        echo '<tr>
<td>'.$value['product_id'].'</td>
<td>'. $value['check_number'] .'</td>
<td>'.$value['date'].'</td>
<td>'. $value['price']/100 .'</td>
        </tr>';

    };
    echo '

</table>';
}