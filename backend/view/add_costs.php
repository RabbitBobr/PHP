<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../view/css/table.css" >
    <link rel="stylesheet" type="text/css" href="../view/css/cost.css" >
    <script src="jq/jq.js"></script>
    <script type="application/javascript" src="jq/jquery.cookie.js"></script>
    <script type="application/javascript" src="jq/all_costs.js"></script>
    <title>Сторонние траты</title>
</head>
<body>
<?php
include_once "../controllers/getCostsController.php";
include_once "../functions/see_costs.php";
if (!isset($_COOKIE['date_start'])) {
    $date_start = "2019-01-01";
} else {
    $date_start = $_COOKIE['date_start'];
}
if (!isset($_COOKIE['date_stop'])) {
    $date_stop = date("Y-m-d");
} else {
    $date_stop = $_COOKIE['date_stop'];
}
?>
    <div id="header">
        <a href="http://www.bobrstore.ru/backend/view/all_checks.php">Список продаж</a> <br />
        <a href="http://www.bobrstore.ru/backend/view/all_products.php">Список товаров</a> <br />
        <a href="http://bobrstore.ru/backend/view/all_static.php">Статистика продаж</a> <br />
        <a href="http://www.bobrstore.ru/backend/view/all_accepts.php">Список принятого товара</a> <br />
        <h1>Сторонние траты</h1>

        <div id="block_submit_see" class="showCost">
            <input type="submit" value="Новые траты" id="see_add_cost_button">
        </div>
        <div id="block_submit_unsee" class="unShowCost">
            <input type="submit" value="Скрыть" id="unsee_add_cost_button">
        </div>

    </div>
    <div id="add_new_cost" class="unShowCost">

            <p><label>Название</label><input type="text" id="new_cost_name" name="new_cost_name"></p>
            <p><label>Дата</label><input type="date" id="new_cost_date" name="new_cost_date" value="<?php echo date("Y-m-d");?>"></p>
            <p><label>Стоимость</label><input type="text" id="new_cost_price" name="new_cost_price"></p>
            <p><label>Описание</label><textarea id="new_cost_comment" name="new_cost_comment"></textarea></p>
            <input type="submit" value="Добавить" id="save_new_cost">

    </div>
    <div id="block_submit_search_see" class="showCost">
        <input type="submit" value="Выборка по дате" id="see_search_cost_button">
    </div>
    <div id="block_submit_search_unsee" class="unShowCost">
        <input type="submit" value="Скрыть поиск" id="unsee_search_cost_button">
    </div>
    <div id="search_block" class="unShowCost">
      <p><label>С</label><input type="date" id="date_start" value="2019-01-01">
      <label>По</label><input type="date" id="date_stop" value="<?php echo date("Y-m-d"); ?>">
          <input type="submit" id="search_date_button" value="Поиск по датам"></p>

        <table id="tab_stat_cost">


        </table>
    </div>
    <div id="see_all_costs"">

        <table id="tab_all_cost">
            <tr>
                <th>Наименование</th>
                <th>Дата</th>
                <th>Стоимость</th>
                <th>Описание</th>
            </tr>
            <?php
            $set_costs = getAll();
            see_all($set_costs);
            ?>
        </table>

    </div>
</body>
</html>