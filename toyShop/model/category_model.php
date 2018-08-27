<?php



function getArrayAllCategory()
{
    include "connect_to_bd.php";
    $query = "SELECT * FROM category";
    $cat = $pdo->prepare($query);
    $cat->execute();

    return $cat->fetchAll();
}

function addNewCategory($type, $category)
{
    include "connect_to_bd.php";
    $query = "INSERT INTO category (id, product_type) VALUES (NULL, {$type}, {$category})";
    $pdo->exec($query);
}

