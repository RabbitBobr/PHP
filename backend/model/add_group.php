<?php
    function save_new_group($name, $uuid) {
        $conn = json_decode(file_get_contents(__DIR__ . '/../resurses/bd_connect.json'), true);
        $mysqli = new mysqli($conn['localhost'], $conn['name'], $conn['pass'], $conn['bd_name']);
        if (mysqli_connect_errno()) {
            printf("Соединение не установлено: %s\n", mysqli_connect_error());
            exit();
        }
        $mysqli->set_charset('utf8');
        $mysqli->query("INSERT INTO parent_group VALUE (NULL, '{$name}', '{$uuid}')");

        $mysqli->close();
    }