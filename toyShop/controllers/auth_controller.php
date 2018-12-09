<?php
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    require_once __DIR__ . "/../model/login_model.php";
    require_once __DIR__ . "/../functions/login_func.php";

    $login = clear_string($_POST['auth_login']);
    $pass = crypt_pass($_POST['auth_pass']);

    $result_auth = auth($login, $pass);

    if($result_auth != false)
    {
        session_start();
        $_SESSION['auth'] = 'yes_auth';
        $_SESSION['login'] = $result_auth['login'];

        echo 'true';
    } else {
        echo 'false';
    }
}

