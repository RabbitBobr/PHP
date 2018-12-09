<?php

function selectAllCosts()
{
    include "connect_to_bd.php";
    $query = "SELECT * FROM costs";
    $costs = $pdo->prepare($query);
    $costs->execute();

    return $costs->fetchAll();
}

function addNewCost($name, $price, $date)
{
    include "connect_to_bd.php";
    $query = "INSERT INTO costs VALUES (NULL, '{$name}', '{$date}', '{$price}')";
    $cost = $pdo->prepare($query);
    $cost->execute();
}
