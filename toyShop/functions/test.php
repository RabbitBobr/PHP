<?php
include __DIR__ . "/../model/costs_model.php";
$_POST['check_date'] = 'false';
$_POST['check_name'] = 'true';
$_POST['cost_name'] = 'Аренда';

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

    print_r($array_costs);

