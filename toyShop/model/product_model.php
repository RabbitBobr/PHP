<?php
function selectAllProducts()
{
    include "connect_to_bd.php";
    $query = "SELECT * FROM products";
    $proc = $pdo->prepare($query);
    $proc->execute();

    return $proc->fetchAll();
}

function getNameById($id)
{
    include "connect_to_bd.php";
    $query = "SELECT * FROM products WHERE id = :id";
    $prod = $pdo->prepare($query);
    $prod->execute([
        'id' => $id
    ]);

    return $prod->fetch()['name'];
}
