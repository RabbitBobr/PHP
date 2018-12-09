<?php


if($_SERVER['REQUEST_METHOD'] == "POST")
{
    include __DIR__ . "/../model/costs_model.php";
    addNewCost($_POST['cost_name'], $_POST['cost_price'], $_POST['cost_date']);

}