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
     <script type="application/javascript" src="jq/allCheck.js"></script>
    <title>Список чеков</title>
</head>
<body>
    <div id="header">
        <a href="http://www.bobrstore.ru/backend/view/all_accepts.php">Список принятого товара</a> <br />
        <a href="http://www.bobrstore.ru/backend/view/all_products.php">Список товаров</a> <br />
        <a href="http://bobrstore.ru/backend/view/all_static.php">Статистика продаж</a> <br />
        <h1>Сторонние чеков</h1>
        <?php
$conn = json_decode(file_get_contents(__DIR__ . '/../resurses/bd_connect.json'), true);
$mysqli = new mysqli($conn['localhost'], $conn['name'], $conn['pass'], $conn['bd_name']);
if (mysqli_connect_errno()) {
    printf("Соединение не установлено: %s\n", mysqli_connect_error());
    exit();
}
$mysqli->set_charset('utf8');
if (!isset($_COOKIE['is_free_price'])) {
    $is_free_price = true;
} else {
    $is_free_price = $_COOKIE['is_free_price']==="true"?true:false;
}
if (!isset($_COOKIE['search_name']) || $_COOKIE['search_name'] === "") {
    $search_name = "";
    $cooc_name = "";
} else {
    $search_name = " AND LOCATE('{$_COOKIE['search_name']}', name)";
    $cooc_name = $_COOKIE['search_name'];
}
?>
        <label><input type="checkbox" id="is_free_price" <?php echo ($is_free_price)?"checked":""; ?>>Не показывать продажи по свободной цене</label><br />
        <div id="search">
            <p>
                <input type="text" id="search_name" value="<?php echo $cooc_name; ?>" /><br />
                <input type="submit" id="search_name_submit" value="Искать по названию" />
                <input type="submit" id="refresh_search_name" value="Сбросить поиск по названию">
            </p>
            <div id="search_date_block">
                <label>С</label>
                <input type="date" value="<?php echo date("Y-m-d");?>" id="date_start">
                <br />
                <label>По</label>
                <input type="date" value="<?php echo date("Y-m-d");?>" id="date_stop">
                <br />
                <input type="submit" id="search_date" value="Применить диапазон дат" />
                <input type="submit" id="stop_date" value="Сбросить даты" />
                <br />
            </div>
            <select id="is_pay">
                <?php
                    if (!isset($_COOKIE['is_pay'])) {
                        $is_pay = "all";
                    } else {
                        $is_pay = $_COOKIE['is_pay'];
                    }
                    echo '<option value="all" ' . ($is_pay==="all"?"selected":"") . ' >Все действия</option>';
                    echo '<option value="accept" ' . ($is_pay==="accept"?"selected":"") . ' >Продажи</option>';
                    echo '<option value="payback" ' . ($is_pay==="payback"?"selected":"") . '>Возврат</option>';
                ?>
            </select>
            <select id="group_list">
                <?php
            $group_result = $mysqli->query("SELECT * FROM parent_group");
            $group_id = (isset($_COOKIE['select_id'])) ? $_COOKIE['select_id'] : "0";

                if ($group_id === null || $group_id === "0") {
                    $group_id = 0;
                    echo "<option value=\"0\" selected>Все товары</option>";
                    $res = $mysqli->query("SELECT * FROM products");
                } else {
                    echo "<option value=\"0\">Все товары</option>";
                    $res = $mysqli->query("SELECT * FROM products WHERE group_id = {$group_id}");
                }


            while ($rew = $group_result->fetch_assoc()) {
                if ($group_id === $rew['id']) {
                    echo "<option value=\"{$rew['id']}\" selected>{$rew['name']}</option>";
                } else {
                    echo "<option value=\"{$rew['id']}\">{$rew['name']}</option>";
                }
            }

            ?>
        </select>
        </div>
    </div>
    <label id="see_date_search"><?php echo (isset($_COOKIE['date_set']))?$_COOKIE['date_set']:""; ?></label><br />
    <div id="table">
        <table>
            <tr>
                <th>Наименование</th>
                <th>Тип</th>
                <th>Дата</th>
                <th>Стоимость</th>
                <th>Количество</th>
            </tr>
            <?php
                include_once __DIR__ . '/../functions/see_products.php';
                if ((!isset($_COOKIE['date_start'])) || (!isset($_COOKIE['date_stop'])) || $_COOKIE['date_start'] === "" || $_COOKIE['date_stop']==="") {
                    $is_date_search = false;
                } else {
                    $date_start = date($_COOKIE['date_start']);
                    $date_stop = date($_COOKIE['date_stop']);
                    $is_date_search = true;
                }
                
                $arr_sql_where = [];
                if ($is_pay === "accept") {
                    $arr_sql_where[] = "type = 1";
                }
                
                if ($is_pay === "payback") {
                    $arr_sql_where[] = "type = 0";
                }
                
                if ($is_date_search === true) {
                    $arr_sql_where[] = "(data > '{$date_start}' AND data <= '{$date_stop}')";
                }
                
                if (count($arr_sql_where)>0){
                    $query = "SELECT * FROM checks WHERE {$arr_sql_where[0]}";
                    if(count($arr_sql_where)>1) {
                        for ($i=1; $i<count($arr_sql_where); $i++) {
                            $query .= " AND {$arr_sql_where[$i]}";
                        }                        
                    }
                    $res = $mysqli->query($query);
                } else {
                    $res = $mysqli->query("SELECT * FROM checks");
                }
                while ($row_check = $res->fetch_assoc()) {
                    $date = date($row_check['data']);
                    $type = $row_check['type'] === "1" ? "Продажа" : "Возврат";
                    $res_sells = $mysqli->query("SELECT * FROM sells WHERE check_id = {$row_check['id']}");
                    if($res_sells->num_rows) {                        
                        while ($row_sells = $res_sells->fetch_assoc()) {
                            $price = $row_sells['price'];
                            $quantity = $row_sells['quantity'];
                            if($group_id === 0) {
                                $res_product = $mysqli->query("SELECT * FROM products WHERE id = {$row_sells['evo_uuid']}" . $search_name);
                            } else {
                                $res_product = $mysqli->query("SELECT * FROM products WHERE id = {$row_sells['evo_uuid']} AND group_id = {$group_id}" . $search_name);
                            }
                            if ($res_product->num_rows) {
                                $row_product = $res_product->fetch_assoc();
                                $name = $row_product['name'];                            
                                check($name, $type, $date, $price, $quantity);
                            }
                        }

                    } else {
                        if ($group_id === 0 && !$is_free_price) {
                            $name = "По свободной цене";
                            $price = $row_check['amount'];
                            $quantity = 0;
                            check($name, $type, $date, $price, $quantity);
                        }
                    }
                }
            ?>
        </table>
    </div>
    <?php
        $mysqli->close();
    ?>
</body>
</html>