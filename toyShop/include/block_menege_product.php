<ul class="category-section-menege" id="category-section-product">
    <li><h3 class="header-category">Управление товарами</h3></li>
    <li><div id="filter-product">
            <div id="block-search-date">
                <input type="checkbox" name="search_date_product" id="search_date_product"><label for="search_date_product">Выборка по диапазону дат</label>
                <label>С</label>
                <input type="date" name="date_start" id="date_start" value="<?php echo date("Y-m-d"); ?>">
                <label>по</label>
                <input type="date" name="date_end" id="date_end" value="<?php echo date("Y-m-d"); ?>">
            </div>
            <div id="block-search-name">
                <input type="checkbox" name="search_name_product" id="search_name_product" /><label for="search_name_product">Только такие затраты</label>
                <input type="text" name="searching_name_product" id="searching_name_product" />
                <input type="button" id="search_product_start_button" value="Применить фильтр" />
                <input type="button" id="search_product_stop_button" value="Сбросить фильтр" />
            </div>
        </div></li>
    <li><a class="okno" href="#add_new_product">Добавить товар</a></li>
    <li id="block-table-product"></li>
</ul>