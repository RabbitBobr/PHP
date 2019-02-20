<?php
    function see_all($arr) {
        foreach ($arr as $value) {
            $price = $value['price'] / 100;
            echo "<tr>";
            echo "<td>{$value['name']}</td>";
            echo "<td>{$value['date']}</td>";
            echo "<td>{$price}</td>";
            echo "<td>{$value['comments']}</td>";
            echo "</tr>";
        }
    }

    function getStatNamePrice($arr) {
        $result_set = [];
        foreach ($arr as $value) {
            if (isset($result_set[$value['name']])) {
                $result_set[$value['name']][1] += $value['price'];
            } else {
                $result_set[$value['name']] = [$value['name'], $value['price']];
            }
        }

        return $result_set;
    }

    function seeStat($arr) {
        $result = "<tr>
                <th>Наименование</th>
                <th>Стоимость</th>
            </tr>";
        foreach ($arr as $value) {
            $price = $value[1] / 100;
            $result .= "<tr>";
            $result .= "<td>{$value[0]}</td>";
            $result .= "<td>{$price}</td>";
            $result .= "</tr>";
        }
        return $result;
    }