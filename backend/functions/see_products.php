<?php
    function see($res_p, $row) {
        $costPrice = $res_p['cost_price']/100;
        $price = $res_p['price']/100;
        echo "<tr>";
        echo "<td>{$row['name']}</td>";
        echo "<td>{$row['barCode']}</td>";
        echo "<td>{$row['quantity']}</td>";
        echo "<td>{$costPrice}</td>";
        echo "<td>{$price}</td>";
        echo "<td>{$row['discription']}</td>";
        echo "</tr>";
    }
    
    function check($name, $type, $date, $price, $quantity) {
        echo "<tr>";
        echo "<td>{$name}</td>";
        echo "<td>{$type}</td>";
        echo "<td>{$date}</td>";
        echo "<td>{$price}</td>";
        echo "<td>{$quantity}</td>";
        echo "</tr>";
    }

    function stat_see($type, $sum, $q, $id) {
        echo "<tr id='{$id}'>";
        echo "<td>{$type}</td>";
        echo "<td>{$sum}</td>";
        echo "<td>{$q}</td>";
        echo "</tr>";
    }

function stat_see_product($name, $sum, $q) {
    echo "<tr>";
    echo "<td>{$name}</td>";
    echo "<td>{$sum}</td>";
    echo "<td>{$q}</td>";
    echo "</tr>";
}
