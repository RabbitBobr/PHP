<?php

function selectAllCosts()
{
    include "connect_to_bd.php";
    $query = "SELECT * FROM costs";
    $costs = $pdo->prepare($query);
    $costs->execute();

    return $costs->fetchAll();
}