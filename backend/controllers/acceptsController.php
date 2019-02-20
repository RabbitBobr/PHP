<?php

    if (array_key_exists('date_start', $_POST) && array_key_exists('date_stop', $_POST)) {
        getTableAcceptsDate($_POST['date_start'], $_POST['date_stop']);
    } else if (array_key_exists('date_one', $_POST)){
        getAcceptsOneDate($_POST['date_one']);
    } else  {
        getTableAcceptsAll();
    }

    function getAcceptsOneDate($date) {
        $arr = include __DIR__ . "/../controllers/getArrayAccepts.php";
        include_once __DIR__ . "/../functions/see_accepts.php";
        $result_sum = 0;
        foreach ($arr as $value) {
            if ($value['date'] === $date) {
                $result_sum += $value['costPrice'] * $value['quantity'];
            }
        }

        echo $date . " было потрачено " . $result_sum . " рублей";
    }

    function getTableAcceptsAll() {
        $arr = include __DIR__ . "/../controllers/getArrayAccepts.php";
        include_once __DIR__ . "/../functions/see_accepts.php";

        see_all_accepts($arr);

    }

    function getTableAcceptsDate($date_start, $date_stop) {
        $arr = include __DIR__ . "/../controllers/getArrayAccepts.php";
        include_once __DIR__ . "/../functions/see_accepts.php";

        $result_array = [];

        foreach ($arr as $value) {
            if ($value['date'] >= $date_start && $value['date'] <= $date_stop) {
                if (count($result_array) === 0) {
                    $result_array[$value['date']] = $value['costPrice'] * $value['quantity'];
                } else {

                    if (array_key_exists($value['date'], $result_array)) {
                        $result_array[$value['date']] += $value['costPrice'] * $value['quantity'];
                    } else {
                        $result_array[$value['date']] = $value['costPrice'] * $value['quantity'];
                    }
                }
            }


        }

        see_date_accepts($result_array);
    }
