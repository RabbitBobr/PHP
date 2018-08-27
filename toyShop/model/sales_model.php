<?php
function selectAllSales()
{
    include "connect_to_bd.php";
    $query = "SELECT * FROM sales";
    $costs = $pdo->prepare($query);
    $costs->execute();

    return $costs->fetchAll();
}