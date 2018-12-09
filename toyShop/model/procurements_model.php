<?php

function selectAllProcurements()
{
    include "connect_to_bd.php";
    $query = "SELECT * FROM procurements";
    $proc = $pdo->prepare($query);
    $proc->execute();

    return $proc->fetchAll();
}