<?php
    function saveGroup($groupList) {
        $conn = json_decode(file_get_contents(__DIR__ . '/../resurses/bd_connect.json'), true);
        $mysqli = new mysqli($conn['localhost'], $conn['name'], $conn['pass'], $conn['bd_name']);
        if (mysqli_connect_errno()) {
            printf("Соединение не установлено: %s\n", mysqli_connect_error());
            exit();
        }
        $mysqli->set_charset('utf8');
        $resultSet = [];
        foreach ($groupList as $value) {
            $result = $mysqli->query("SELECT id FROM parent_group WHERE name = '{$value}'");
            if(!$result->num_rows) {
                $mysqli->query("INSERT INTO parent_group VALUE (NULL, '{$value}')");
                $resultSet[$value] = $mysqli->insert_id;
        } else {
                $resultSet[$value] = $result->fetch_assoc()['id'];
            }
        }
        $mysqli->close();
        return $resultSet;
    }