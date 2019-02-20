<?php
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    include __DIR__ . "/../model/costs_model.php";
    $name = trim($_POST['name'], " ");
    $date = date($_POST['date']);
    $price = $_POST['price'] * 100;
    addNewCost($name, $date, $price, $_POST['comment']);
}