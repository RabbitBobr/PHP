<?php
 function search_name($arr, $name) {
     $is_name = false;
     for ($i = 0; $i < count($arr); $i++) {
         if ($arr[$i]['name'] === $name) {
             $is_name = $i;
             break;
         }
     }

     return $is_name;
 }