<?php
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {

        $array_data = explode("&", $_POST['form_array']);


        if (count($array_data) > 2)
        {
                $names = [];
                $prices = [];
                $sizes = [];

                    for($n=0, $p=1, $s=2; $s<count($array_data); $n+=3, $p+=3, $s+=3) {
                        $names[] = explode("=", $array_data[$n])[1];
                        $prices[] = explode("=", $array_data[$p])[1];
                        $sizes[] = explode("=", $array_data[$s])[1];
                    }



            $result_string = "";

            for ($i = 0; $i < count($names); $i++)
            {
                $result_string .= '
            <div class="add_data_purchase_block">
            <label>' . (($i+1)<10 ? ($i+1)."&nbsp;&nbsp;" : $i+1) . '</label>
                <input list="set_data_list_product_names" class="purchase_product_name" name="purchase_product_name[]" type="text" placeholder="Название товара" value="' . $names[$i] . '"/>
                <input class="purchase_product_price" name="purchase_product_price[]" type="text" placeholder="Стоимость" value="' . $prices[$i] . '"/>
                <input class="purchase_product_size" name="purchase_product_size[]" type="text" placeholder="Кол-во" value="' . $sizes[$i] . '" />
            </div>';
            };
            if (count($names) + $_POST['add_string'] > 20)
                $_POST['add_string'] = 20 - count($names);
            $space = " ";
            for ($i=0, $j = count($names)+1; $i<$_POST['add_string'];$i++, $j++)
            {
                $result_string .= '
            <div class="add_data_purchase_block">
                <label>' . ($j<10 ? ($j . "&nbsp;&nbsp;") : $j) . '</label>
                <input list="set_data_list_product_names" class="purchase_product_name" name="purchase_product_name[]" type="text" placeholder="Название товара" />
                <input class="purchase_product_price" name="purchase_product_price[]" type="text" placeholder="Стоимость" />
                <input class="purchase_product_size" name="purchase_product_size[]" type="text" placeholder="Кол-во" />
            </div>';
            }


                $result_string .= '<input type="submit" id="add_data_purchase_submit" value="Отправить" />
    <a href="#" class="close" id="close_win">Закрыть</a>';
                echo $result_string;


        }
    }

