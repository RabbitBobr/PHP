<?php
function clear_string($cl_str)
{

    $cl_str = strip_tags($cl_str);
    $cl_str = trim($cl_str);

    return $cl_str;
};

function crypt_pass($str)
{
    $str = clear_string($str);
    $str   = md5($str);
    $str   = strrev($str);
    $str   = strtolower("9nm2rv8q".$str."2yo6z");

    return $str;
}