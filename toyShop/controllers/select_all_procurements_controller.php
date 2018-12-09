<?php
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    include __DIR__ . "/../model/procurements_model.php";
    include __DIR__ . "/../model/product_model.php";

    $array_proc = selectAllProcurements();
    echo '
<table class="simple-little-table" cellspaising="0">
<tr>
    <th>Наименование товара</th>
    <th>Поставщик</th>
    <th>Накладная</th>
    <th>Дата</th>
    <th>Количество</th>
    <th>Стоимость</th>
</tr>';
    foreach ($array_proc as $value)
    {
        echo '<tr>
<td>'. getNameById($value['product_id']) .'</td>
<td>'. $value['provider'] .'</td>
<td>'.$value['invoice'].'</td>
<td>'.$value['date'].'</td>
<td>'.$value['size'].'</td>
<td>'. $value['price']/100 .'</td>
        </tr>';
    };
    echo '
</table>';
}