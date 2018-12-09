<?php
include "controllers/set_category_controller.php";
 ?>
<div id="block-category">
    <p class="header-title" >Категории товаров</p>

    <ul>

        <li><a id="index1" ><img src="images/mobile-icon.gif" id="mobile-images" />Игрушки</a>
            <ul class="category-section">
                <li><a href="#"><strong>Все группы</strong> </a></li>
                <?php
                $toys = getCategory("Игрушки");
                foreach ($toys as $value)
                {
                    echo '<li><a href="#">'.$value.'</a></li>';
                }
                unset($value);
                ?>

            </ul>
        </li>

        <li><a id="index2" ><img src="images/book-icon.gif" id="book-images" />Одежда</a>
            <ul class="category-section">
                <li><a href="#"><strong>Все виды</strong> </a></li>
                <?php
                $clothes = getCategory("Одежда");
                foreach ($clothes as $value)
                {
                    echo '<li><a href="#">'.$value.'</a></li>';
                }
                unset($value);
                ?>
            </ul>
        </li>

        <li><a id="index3" ><img src="images/table-icon.gif" id="table-images" />Канцелярия</a>
            <ul class="category-section">
                <li><a href="#"><strong>Все типы</strong> </a></li>
                <?php
                $can = getCategory("Канцелярские товары");
                foreach ($can as $value)
                {
                    echo '<li><a href="#">'.$value.'</a></li>';
                }
                unset($value);
                ?>
            </ul>
        </li>

    </ul>

</div>