<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../view/css/table.css" >
    <script src="jq/jq.js"></script>
    <script type="application/javascript" src="jq/jquery.cookie.js"></script>
    <script type="application/javascript" src="jq/allProduct.js"></script>
    <title>Список товаров</title>
</head>
<body>
<div id="header">
    <a href="http://www.bobrstore.ru/backend/view/all_checks.php">Список продаж</a> <br />
    <a href="http://www.bobrstore.ru/backend/view/all_accepts.php">Список принятого товара</a> <br />
    <a href="http://bobrstore.ru/backend/view/all_static.php">Статистика продаж</a> <br />
    <br />
    <h1>Список товаров</h1>
<?php
$conn = json_decode(file_get_contents(__DIR__ . '/../resurses/bd_connect.json'), true);
$mysqli = new mysqli($conn['localhost'], $conn['name'], $conn['pass'], $conn['bd_name']);
if (mysqli_connect_errno()) {
    printf("Соединение не установлено: %s\n", mysqli_connect_error());
    exit();
}
$mysqli->set_charset('utf8');
$search_string = (isset($_COOKIE['search_string'])) ? $_COOKIE['search_string'] : '';
$is_filter = (isset($_COOKIE['filter'])) ? $_COOKIE['filter'] : "false";
if ($is_filter === null || $is_filter === 'false') {
    echo '<label><input type="checkbox" id="is_filter"/>Применять фильтр</label><br />';
    $is_filter = false;
}
else {
    echo '<label><input type="checkbox" id="is_filter" checked/>Применять фильтр</label><br />';
    $is_filter = true;
}
?>
    <a href="../controllers/getProducsDoc.php">Обновить список товаров</a>
    <div id="search">
        <br />

        <label>Настройки поиска</label><br />
        <div id="search_data">
            <?php
            $is_name = (isset($_COOKIE['is_name'])) ? $_COOKIE['is_name'] : 'false';
            if ($is_name === null || $is_name === 'false') {
                echo '<label><input type="checkbox" id="is_name"/>Название</label>';
                $is_name = false;
            } else {
                echo '<label><input type="checkbox" id="is_name" checked/>Название</label>';
                $is_name = true;
            };

            $is_article = (isset($_COOKIE['is_article'])) ? $_COOKIE['is_article'] : 'false';
            if ($is_article === null || $is_article === 'false') {
                echo '<label><input type="checkbox" id="is_article"/>Артикул</label>';
                $is_article = false;
            } else {
                echo '<label><input type="checkbox" id="is_article" checked/>Артикул</label>';
                $is_article = true;
            };

            $is_description = (isset($_COOKIE['is_description'])) ? $_COOKIE['is_description'] : 'false';
            if ($is_description === null || $is_description === 'false') {
                $is_description = false;
                echo '<label><input type="checkbox" id="is_description" />Описание</label>';
            }
            else {
                $is_description = true;
                echo '<label><input type="checkbox" id="is_description" checked />Описание</label>';
            };
            echo "<br />";
                $is_barcode = (isset($_COOKIE['is_barcode'])) ? $_COOKIE['is_barcode'] : 'false';
                if ($is_barcode === null || $is_barcode === 'false') {
                    echo '<label><input type="checkbox" id="is_barcode"/>Штрихкод</label>';
                    $is_barcode = false;
                } else {
                    echo '<label><input type="checkbox" id="is_barcode" checked/>Штрихкод</label>';
                    $is_barcode = true;
                };
            echo "<br />";
            $is_quantity = (isset($_COOKIE['is_quantity'])) ? $_COOKIE['is_quantity'] : 'false';
            if ($is_quantity === null || $is_quantity === 'false') {
                $is_quantity = false;
                echo '<label><input type="checkbox" id="is_quantity" />В наличии</label>';
            }
            else {
                $is_quantity = true;
                echo '<label><input type="checkbox" id="is_quantity" checked />В наличии</label>';
            };
            ?>

            <br />
            <input type="text" name="str_search" id="str_search" value="<?php echo "{$search_string}";?>"/><br />
            <input type="button" id="button_str_search" value="Применить"/>
        </div>


    <select id="group_list">

        <?php
        $group_result = $mysqli->query("SELECT * FROM parent_group");
        $group_id = (isset($_COOKIE['select_id'])) ? $_COOKIE['select_id'] : "0";
        if ($is_filter === "false" || $is_filter === null) {

            if ($group_id === null || $group_id === "0") {
                $group_id = 0;
                echo "<option value=\"0\" selected>Все товары</option>";
                $res = $mysqli->query("SELECT * FROM products");
            } else {
                echo "<option value=\"0\">Все товары</option>";
                $res = $mysqli->query("SELECT * FROM products WHERE group_id = {$group_id}");
            }
        } else {
            if ($group_id === null || $group_id === "0") {
                $group_id = 0;
                echo "<option value=\"0\" selected>Все товары</option>";
                $res = $mysqli->query("SELECT * FROM products");
            } else {
                echo "<option value=\"0\">Все товары</option>";
                $res = $mysqli->query("SELECT * FROM products WHERE group_id = {$group_id}");
            }
        }

        while ($rew = $group_result->fetch_assoc()) {
            if ($group_id === $rew['id'])
                echo "<option value=\"{$rew['id']}\" selected>{$rew['name']}</option>";
            else
                echo "<option value=\"{$rew['id']}\">{$rew['name']}</option>";
        };

        ?>
    </select>
    </div>
</div>
<div id="table">
    <table>
        <tr>
            <th>Название</th>
            <th>Штрихкод</th>
            <th>Количество</th>
            <th>Цена закупки</th>
            <th>Цена продажи</th>
            <th>Описание</th>
        </tr>

        <?php
        include_once __DIR__ . "/../functions/see_products.php";
        if (!$is_filter) {
            $res = $mysqli->query("SELECT * FROM products");
            while ($row = $res->fetch_assoc()) {
                $s_res = $mysqli->query("SELECT cost_price, price FROM price WHERE product_id = {$row['id']}");
                while ($res_p = $s_res->fetch_assoc()) {
                    see($res_p, $row);
                }
            }
        } else {
            $query_search = "SELECT * FROM products";
            $search_array = [];
            if ($group_id !== 0) {
                $search_array[] = "group_id = {$group_id}";
            }

            if ($is_quantity) {
                $search_array[] = "quantity > 0";
            }

            $or_array = [];

            if ($search_string !== null && $search_string !== "") {
                if ($is_barcode) {
                    $or_array[] = "LOCATE ('{$search_string}', barCode)";
                }
                if ($is_article) {
                    $or_array[] = "LOCATE ('{$search_string}', article)";
                }
                if ($is_name) {
                    $or_array[] = "LOCATE ('{$search_string}', name)";
                }
                if ($is_description) {
                    $or_array[] = "LOCATE ('{$search_string}', discription)";
                }
            }

            if (count($search_array) > 0) {
                $query_search .= " WHERE " . $search_array[0];
                if (count($search_array) > 1) {
                    for($i = 1; $i<count($search_array); $i++)
                        $query_search .= " AND " . $search_array[$i];
                }
                if (count($or_array) > 0) {
                    $query_search .= " AND (" . $or_array[0];
                    for ($i = 1; $i<count($or_array);$i++) {
                        $query_search .= " OR " . $or_array[$i];
                    }
                    $query_search .= ")";
                }
            } else if (count($or_array) > 0) {
                $query_search .= " WHERE " . $or_array[0];
                if (count($or_array) > 1) {
                    for ($i = 1; $i < count($or_array); $i++) {
                        $query_search .= " OR " . $or_array[$i];
                    }
                }
            }
            $res = $mysqli->query($query_search);
            while ($row = $res->fetch_assoc()) {
                $s_res = $mysqli->query("SELECT cost_price, price FROM price WHERE product_id = {$row['id']}");
                while ($res_p = $s_res->fetch_assoc()) {
                    see($res_p, $row);
                }
            }
        }
        $mysqli->close();
        ?>
    </table>
</div>
</body>
</html>
