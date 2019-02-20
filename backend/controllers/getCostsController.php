<?php
    function getAll() {
        include_once "../model/costs_model.php";

        $res = getAllCosts();
        $result = [];
        while ($row = $res->fetch_assoc()) {
            $result[] = $row;
        }

        return $result;
    }