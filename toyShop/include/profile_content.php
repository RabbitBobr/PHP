<!-- Выбор режима работы -->
<div id="block-menu">
    <ul id="profile-top-menu">
        <li><a id="select-product">Список товаров</a>
            <?php
            include "include/block_menege_product.php";
            ?>
        </li>
        <li><a id="select-sale">Продажи</a>
            <?php
            include "include/block_menege_sale.php";
            ?>
        </li>
        <li><a id="select-purchase">Закупка</a>
            <?php
                include "include/block_menege_purchase.php";
            ?>
        </li>
        <li><a id="select-costs">Прочие траты</a>
            <?php
                include "include/block_menege_costs.php";
            ?>
        </li>

        </li>
        <li><a id="statistics">Статистика</a>
            <ul class="category-section-menege">
                <li>Статистика</li>
                <li>Фильтр</li>
                <li>Таблица</li>
            </ul>
        </li>
    </ul>
</div>

<div id="search-in-table">
    <div id="bottom-line"></div>
    <h3 id="search-header"></h3>
</div>
<div id="see-table">

</div>

<div id="okno">
    <p></p>


</div>

<div id="add_new_purchase">
    <div id="add_purchase_header">
        <?php
            include "add_new_purchase_form.php";
        ?>
        <div id="add_new_product_purchase">
            <?php
                include "add_new_product_form.php";
            ?>
        </div>
    </div>

</div>

<div id="add_new_sale">
    <div id="add_sale_header">
        <div id="header_sale_add">
            <input id="sale_new_check" placeholder="Номер чека" type="text" />
            <input id="sale_date_check" type="date" value="<?php echo date("Y-m-d");?>" />
            <a id="add_string_sale">Добавить строки</a><input class="add_count" id="add_count_sale" value="1"/>
        </div>
        <form align="left"  id="add_data_sale_form">
            <div class="add_data_sale_block">
                <label >1&nbsp;&nbsp;</label>
                <input class="sale_product_name" name="sale_product_name[]" type="text" placeholder="Название товара" />
                <input class="sale_product_price" name="sale_product_price[]" type="text" placeholder="Стоимость" />
                <input class="sale_product_size" name="sale_product_size[]" type="text" placeholder="Кол-во" />
            </div>
            <div class="add_data_sale_block">
                <label id="max_string">2&nbsp;&nbsp;</label>
                <input class="sale_product_name" name="sale_product_name[]" type="text" placeholder="Название товара" />
                <input class="sale_product_price" name="sale_product_price[]" type="text" placeholder="Стоимость" />
                <input class="sale_product_size" name="sale_product_size[]" type="text" placeholder="Кол-во" />
            </div>
            <input type="submit" id="add_data_sale_submit" value="Отправить" />
            <a href="#" class="close" id="close_win">Закрыть</a>
        </form>

    </div>

</div>

<div id="add_new_product">

    <?php
        include "add_new_product_form.php";
    ?>

</div>


<div id="popUp">
    <span id="close">X</span>
    <p>
        <label></label>
    </p>
    <input id="add_new_category_name_product" type="text" placeholder="Новая категория">
    <input id="add_new_category_button_product" type="submit" value="Добавить категорию">
</div>
<div id="overlay"></div>

<datalist id="set_data_list_product_names">

</datalist>
