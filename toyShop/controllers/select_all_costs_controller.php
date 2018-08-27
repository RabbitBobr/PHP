<?php
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    include __DIR__ . "/../model/costs_model.php";

    $array_costs = selectAllCosts();
    $sum = 0;
    echo '
<table class="simple-little-table" cellspaising="0">

<tr>
    <th>Наименование траты</th>
    <th>Стоимость</th>
    <th>Дата</th>
</tr>';
    foreach ($array_costs as $value)
    {
        echo '<tr>
<td>'.$value['name'].'</td>
<td>'. $value['price']/100 .'</td>
<td>'.$value['date'].'</td>
        </tr>';
        $sum += $value['price'];
    };
    echo '
<td>Всего</td>
<td>'. $sum/100 .'</td>
</table>';
}