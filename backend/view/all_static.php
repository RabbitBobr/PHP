<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../view/css/table.css" >
    <link rel="stylesheet" type="text/css" href="../view/css/static.css" >
    <script src="jq/jq.js"></script>
    <script type="application/javascript" src="jq/jquery.cookie.js"></script>
    <script type="application/javascript" src="jq/allStatic.js"></script>
    <title>Статистика продаж</title>
</head>
<body>
<a href="http://www.bobrstore.ru/backend/view/all_checks.php">Список продаж</a> <br />
<a href="http://www.bobrstore.ru/backend/view/all_accepts.php">Список принятого товара</a> <br />
<a href="http://www.bobrstore.ru/backend/view/all_products.php">Список товаров</a> <br />

<h1>Статистика продаж</h1>

<?php
$conn = json_decode(file_get_contents(__DIR__ . '/../resurses/bd_connect.json'), true);
$mysqli = new mysqli($conn['localhost'], $conn['name'], $conn['pass'], $conn['bd_name']);
if (mysqli_connect_errno()) {
    printf("Соединение не установлено: %s\n", mysqli_connect_error());
    exit();
}
$mysqli->set_charset('utf8');
if (!isset($_COOKIE['date_start']) || $_COOKIE['date_start'] === "") {
    $date_start = "2018-12-01";
} else {
    $date_start = $_COOKIE['date_start'];
}

if (!isset($_COOKIE['date_stop']) || $_COOKIE['date_stop'] === "") {
    $date_stop = date("Y-m-d");
} else {
    $date_stop = $_COOKIE['date_stop'];
}

?>
<div id="search">
    <p>
        <label>С</label>
        <input type="date" id="search_date_start" value="<?php echo $date_start; ?>">
        <label>По</label>
        <input type="date" id="search_date_stop" value="<?php echo $date_stop; ?>"> <br />
        <input type="submit" value="Применить выборку по датам" id="search_button_date">
        <input type="submit" value="Сбросить выборку по датам" id="refresh_button_date">
    </p>
</div>
<table>
    <tr>
        <th>Категория</th>
        <th>Сумма</th>
        <th>Количество</th>
    </tr>

<?php
    $res_check = $mysqli->query("SELECT * FROM checks WHERE data > '{$date_start}' AND data <= '{$date_stop}'");
    $toyses = ["sum" => 0, "quantity" => 0, "products" => []];
    $penses = ["sum" => 0, "quantity" => 0, "products" => []];
    $clotheses = ["sum" => 0, "quantity" => 0, "products" => []];
    $arr_sum = ["toys" => $toyses, "pen" => $penses, "clothes" => $clotheses];

    $group_id = [];
    $group = $mysqli->query("SELECT * FROM parent_group");
    while ($g = $group->fetch_assoc()) {
        $group_id[$g['name']] = $g['id'];
    }
    if ($res_check->num_rows) {
        while ($check = $res_check->fetch_assoc()) {
            $res_sells = $mysqli->query("SELECT * FROM sells WHERE check_id = {$check['id']}");
            if ($res_sells->num_rows) {
                while ($sell = $res_sells->fetch_assoc()) {
                    $query = "SELECT * FROM products WHERE id = {$sell['evo_uuid']}";
                    $res_product = $mysqli->query($query);
                    $products = $res_product->fetch_assoc();
                    include_once __DIR__ . "/../functions/search_name.php";
                    switch ($products['group_id']) {
                        case $group_id['детская одежда']: {
                            $sum = $sell['price'] * $sell['quantity'];
                            $arr_sum['clothes']['sum'] += $sum;
                            $arr_sum['clothes']['quantity'] += $sell['quantity'];
                            $is_name = search_name($arr_sum['clothes']['products'], $products['name']);
                            if ($is_name === false) {
                                $tmp = ["name" => $products['name'], "sum" => $sum, "quantity" => $sell['quantity']];
                                $arr_sum['clothes']['products'][] = $tmp;
                            } else {
                                $arr_sum['clothes']['products'][$is_name]['sum'] += $sum;
                                $arr_sum['clothes']['products'][$is_name]['quantity'] += $sell['quantity'];
                            }

                        }; break;
                        case $group_id['игрушки']: {
                            $sum = $sell['price'] * $sell['quantity'];
                            $arr_sum['toys']['sum'] += $sum;
                            $arr_sum['toys']['quantity'] += $sell['quantity'];
                            $is_name = search_name($arr_sum['toys']['products'], $products['name']);
                            if ($is_name === false) {
                                $tmp = ["name" => $products['name'], "sum" => $sum, "quantity" => $sell['quantity']];
                                $arr_sum['toys']['products'][] = $tmp;
                            } else {
                                $arr_sum['toys']['products'][$is_name]['sum'] += $sum;
                                $arr_sum['toys']['products'][$is_name]['quantity'] += $sell['quantity'];
                            }
                        }; break;
                        case $group_id['канцелярские товары']: {
                            $sum = $sell['price'] * $sell['quantity'];
                            $arr_sum['pen']['sum'] += $sum;
                            $arr_sum['pen']['quantity'] += $sell['quantity'];
                            $is_name = search_name($arr_sum['pen']['products'], $products['name']);
                            if ($is_name === false) {
                                $tmp = ["name" => $products['name'], "sum" => $sum, "quantity" => $sell['quantity']];
                                $arr_sum['pen']['products'][] = $tmp;
                            } else {
                                $arr_sum['pen']['products'][$is_name]['sum'] += $sum;
                                $arr_sum['pen']['products'][$is_name]['quantity'] += $sell['quantity'];
                            }
                        }; break;
                    }

                }
            }
        }
    }
include_once __DIR__ . "/../functions/see_products.php";


stat_see("Игрушки", $arr_sum['toys']['sum']/100, $arr_sum['toys']['quantity'], "str_toy");
stat_see("Канцелярия", $arr_sum['pen']['sum']/100, $arr_sum['pen']['quantity'], "str_pen");
stat_see("Одежда", $arr_sum['clothes']['sum']/100, $arr_sum['clothes']['quantity'], "str_clothes");

$mysqli->close();
?>
</table>
<div id="block_products_see">
    <div id="table_toys" class="prod" >
        <table class="unShow">
            <tr>
                <th>Название</th>
                <th>Сумма</th>
                <th>Количество</th>
            </tr>
            <?php
                foreach ($arr_sum['toys']['products'] as $value) {
                    if ($value['quantity'] !== 0) {
                        stat_see_product($value['name'], $value['sum'] / 100, $value['quantity']);
                    }
                }
            ?>
        </table>
    </div>
    <div id="table_clothes" class="prod">
        <table class="unShow">
            <tr>
                <th>Название</th>
                <th>Сумма</th>
                <th>Количество</th>
            </tr>
            <?php
            foreach ($arr_sum['clothes']['products'] as $value) {
                if ($value['quantity'] !== 0) {
                    stat_see_product($value['name'], $value['sum']/100, $value['quantity']);
                }
            }
            ?>
        </table>
    </div>
    <div id="table_pen" class="prod">
        <table class="unShow">
            <tr>
                <th>Название</th>
                <th>Сумма</th>
                <th>Количество</th>
            </tr>
            <?php
            foreach ($arr_sum['pen']['products'] as $value) {
                if ($value['quantity'] !== 0) {
                    stat_see_product($value['name'], $value['sum'] / 100, $value['quantity']);
                }
            }
            ?>
        </table>
    </div>

</div>
</body>
</html>