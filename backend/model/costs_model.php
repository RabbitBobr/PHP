<?php
    function addNewCost($name, $date, $price, $comment) {
        $conn = json_decode(file_get_contents(__DIR__ . '/../resurses/bd_connect.json'), true);
        $mysqli = new mysqli($conn['localhost'], $conn['name'], $conn['pass'], $conn['bd_name']);
        if (mysqli_connect_errno()) {
            printf("Соединение не установлено: %s\n", mysqli_connect_error());
            exit();
        }
        $mysqli->set_charset('utf8');

        $query = "INSERT INTO costs VALUE(NULL, '$name', '$date', $price, '$comment')";
        $mysqli->query($query);

        $mysqli->close();
    }

    function getAllCosts() {
        $conn = json_decode(file_get_contents(__DIR__ . '/../resurses/bd_connect.json'), true);
        $mysqli = new mysqli($conn['localhost'], $conn['name'], $conn['pass'], $conn['bd_name']);
        if (mysqli_connect_errno()) {
            printf("Соединение не установлено: %s\n", mysqli_connect_error());
            exit();
        }
        $mysqli->set_charset('utf8');

        $res = $mysqli->query("SELECT * FROM costs");

        $mysqli->close();

        return $res;
    }

    function getCostDate($start, $stop) {
        $conn = json_decode(file_get_contents(__DIR__ . '/../resurses/bd_connect.json'), true);
        $mysqli = new mysqli($conn['localhost'], $conn['name'], $conn['pass'], $conn['bd_name']);
        if (mysqli_connect_errno()) {
            printf("Соединение не установлено: %s\n", mysqli_connect_error());
            exit();
        }
        $mysqli->set_charset('utf8');
        $res = $mysqli->query("SELECT * FROM costs WHERE date > '$start' AND date <= '$stop'");
        $mysqli->close();
        return $res;
    }