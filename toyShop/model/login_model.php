<?php


function auth($login, $pass) {
    require_once "connect_to_bd.php";

    $query = "SELECT * FROM users WHERE login = :login AND pass = :pass";
    $user = $pdo->prepare($query);
    $user->execute([
        'login' => $login,
        'pass' => $pass
    ]);

    return $user->fetch();
}
