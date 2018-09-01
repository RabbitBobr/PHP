<?php
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    include __DIR__ . "/../model/costs_model.php";
    if ($_POST['check_date'] == 'true' || $_POST['check_name'] == 'true')
    {
        $array_costs = selectAllCosts();
        $sum = 0;
        $checked_date = ($_POST['check_date'] == 'true');
        $checked_name = ($_POST['check_name'] == 'true');

        $array_costs_copy = $array_costs;

        foreach ($array_costs_copy as $key => $value)
        {
            if($checked_name)
            {
                if($value['name'] != $_POST['cost_name'])
                {
                    unset($array_costs[$key]);
                    continue;
                }
            }
            if($checked_date)
            {
                if($value['date'] < $_POST['date_start'] || $value['date'] > $_POST['date_stop'])
                {
                    unset($array_costs[$key]);
                    continue;
                }
            }


        }

        unset($value);

        echo '


<table id="simple-little-table-cost" class="simple-little-table" cellspaising="0">

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
}