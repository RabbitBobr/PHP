<?php

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    include __DIR__ . "/../model/costs_model.php";
    include_once  __DIR__ . "/../functions/see_costs.php";
    $date_start = $_POST['date_start'];
    $date_stop = $_POST['date_stop'];
    $res = getCostDate($date_start, $date_stop);
    $result = [];
    while ($row = $res->fetch_assoc()) {
        $result[] = $row;
    }

    $result = getStatNamePrice($result);

    echo seeStat($result);
}