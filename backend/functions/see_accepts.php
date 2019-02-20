<?php
    function see_all_accepts($arr) {
        foreach ($arr as $value) {
            echo "<tr>";
            echo "<td>{$value['name']}</td>";
            echo "<td>{$value['costPrice']}</td>";
            echo "<td>{$value['date']}</td>";
            echo "<td>{$value['provider']}</td>";
            echo "<td>{$value['quantity']}</td>";
            echo "</tr>";
        }
    }

    function see_date_accepts($arr) {
        echo "<tr>
                <th>Дата</th>
                <th>Стоимость</th>
            </tr>";
        $sum = 0;
        foreach ($arr as $key => $value) {
            echo "<tr>";
            echo "<td>{$key}</td>";
            echo "<td>{$value}</td>";
            echo "</tr>";
            $sum += $value;
        }

        echo "<tr><td>Общая сумма</td><td>{$sum}</td></tr>";
    }