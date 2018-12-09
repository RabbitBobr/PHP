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

function addNewProduct($name, $vendor_code, $type, $image_name)
{
    include "connect_to_bd.php";
    $query = "INSERT INTO products VALUES (NULL, :name, :code, 0, :type, 0, :image)";
    $prod = $pdo->prepare($query);
    $prod->execute([
        'name' => $name,
        'code' => $vendor_code,
        'type' => $type,
        'image' => $image_name
    ]);
}
