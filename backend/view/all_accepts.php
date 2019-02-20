<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../view/css/table.css" >
    <link rel="stylesheet" type="text/css" href="../view/css/accept.css" >
    <script src="jq/jq.js"></script>
    <script type="application/javascript" src="jq/jquery.cookie.js"></script>
    <script type="application/javascript" src="jq/accepts.js"></script>
    <title>Приход товара</title>
</head>
<body>
    <div id="header">
        <a href="http://www.bobrstore.ru/backend/view/all_checks.php">Список продаж</a> <br />
        <a href="http://www.bobrstore.ru/backend/view/all_products.php">Список товаров</a> <br />
        <a href="http://bobrstore.ru/backend/view/all_static.php">Статистика продаж</a> <br />
        <a href="http://www.bobrstore.ru/backend/view/add_costs.php">Сторонние траты</a> <br />
        <h1>Приход товара</h1>

        <div id="search">
            <div id="search_accepts_one_date">
                <p><label>Поиск по конкретной дате</label>
                    <input type="date" id="date_one" value="<?php echo date("Y-m-d"); ?>">
                    <input type="submit" id="one_date_search" value="Искать">
                </p>
                <p>
                    <h2 id="see_one_date_sum"></h2>
                </p>
            </div>
            <div id="block_submit_search_see" class="showCost">
                <input type="submit" value="Выборка по дате" id="see_search_cost_button">
            </div>
            <div id="block_submit_search_unsee" class="unShowCost">
                <input type="submit" value="Скрыть поиск" id="unsee_search_cost_button">
            </div>
            <div id="search_block" class="unShowCost">
                <p><label>С</label><input type="date" id="date_start" value="2018-12-01">
                    <label>По</label><input type="date" id="date_stop" value="<?php echo date("Y-m-d"); ?>">
                    <input type="submit" id="search_date_button" value="Поиск по датам"></p>

                <table id="tab_stat_cost">
                </table>
            </div>
        </div>
    </div>
    <div id="table">
        <table>
            <tr>
                <th>Наименование</th>
                <th>Закупка</th>
                <th>Дата</th>
                <th>Поставщик</th>
                <th>Количество</th>
            </tr>
            <?php

            include_once __DIR__ . "/../controllers/acceptsController.php";

            ?>
        </table>
    </div>
</body>
</html>