<ul class="category-section-menege" id="category-section-purchase">
    <li><h3 class="header-category">Управление закупками</h3></li>
    <li><div id="filter-purchase">
            <div id="block-search-date">
                <input type="checkbox" name="search_date_purchase" id="search_date_purchase"><label for="search_date_purchase">Выборка по диапазону дат</label>
                <label>С</label>
                <input type="date" name="date_start" id="date_start" value="<?php echo date("Y-m-d"); ?>">
                <label>по</label>
                <input type="date" name="date_end" id="date_end" value="<?php echo date("Y-m-d"); ?>">
            </div>
            <div id="block-search-name">
                <input type="checkbox" name="search_name_purchase" id="search_name_purchase" /><label for="search_name_purchase">Только такие затраты</label>
                <input type="text" name="searching_name_purchase" id="searching_name_purchase" />
                <input type="button" id="search_purchase_start_button" value="Применить фильтр" />
                <input type="button" id="search_purchase_stop_button" value="Сбросить фильтр" />
            </div>
        </div></li>
    <li><a class="okno" href="#add_new_purchase">Внести данные о закупке</a></li>
    <li id="block-table-purchase"></li>
</ul>
