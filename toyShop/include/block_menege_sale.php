<ul class="category-section-menege" id="category-section-sale">
    <li><h3 class="header-category">Управление продажами</h3></li>
    <li><div id="filter-sale">
            <div id="block-search-date">
                <input type="checkbox" name="search_date_sale" id="search_date_sale"><label for="search_date_sale">Выборка по диапазону дат</label>
                <label>С</label>
                <input type="date" name="date_start" id="date_start" value="<?php echo date("Y-m-d"); ?>">
                <label>по</label>
                <input type="date" name="date_end" id="date_end" value="<?php echo date("Y-m-d"); ?>">
            </div>
            <div id="block-search-name">
                <input type="checkbox" name="search_name_sale" id="search_name_sale" /><label for="search_name_sale">Только такие затраты</label>
                <input type="text" name="searching_name_sale" id="searching_name_sale" />
                <input type="button" id="search_sale_start_button" value="Применить фильтр" />
                <input type="button" id="search_sale_stop_button" value="Сбросить фильтр" />
            </div>
        </div></li>
    <li><a class="okno" href="#add_new_sale">Внести данные о продаже</a></li>
    <li id="block-table-sale"></li>
</ul>