<?php
function selectAllProducts()
{
    include "connect_to_bd.php";
    $query = "SELECT * FROM products";
    $proc = $pdo->prepare($query);
    $proc->execute();

    return $proc->fetchAll();
}