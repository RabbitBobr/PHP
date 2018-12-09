<ul class="category-section-menege" id="category-section-cost">
    <li><h3 class="header-category">Управление тратами</h3></li>
    <li><div id="filter-costs">
            <div id="block-search-date">
                <input type="checkbox" name="search_date_cost" id="search_date_cost"><label for="search_date_cost">Выборка по диапазону дат</label>
                <label>С</label>
                <input type="date" name="date_start" id="date_start" value="<?php echo date("Y-m-d"); ?>">
                <label>по</label>
                <input type="date" name="date_end" id="date_end" value="<?php echo date("Y-m-d"); ?>">
            </div>
            <div id="block-search-name">
                <input type="checkbox" name="search_name_cost" id="search_name_cost" /><label for="search_name_cost">Только такие затраты</label>
                <input type="text" name="searching_name_cost" id="searching_name_cost" />
                <input type="button" id="search_cost_start_button" value="Применить фильтр" />
                <input type="button" id="search_cost_stop_button" value="Сбросить фильтр" />
            </div>
        </div>
    </li>
    <li id="block-table-costs"></li>
    <li><div id="add_new_cost">
            <label>Внесение затрат</label><br />
            <input type="text" id="cost_name" name="cost_name" placeholder="Наименование затрат" /><br />
            <input type="text" id="cost_price" name="cost_price" placeholder="Стоимость"><br />
            <input type="date" id="cost_date" name="cost_date" value="<?php echo date("Y-m-d"); ?>"><br />
            <input type="button" value="Добавить" id="add_new_cost_button" />
        </div>
    </li>
</ul>
