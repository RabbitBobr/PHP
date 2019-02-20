<?php
    

    function doc_wright_off($data) {

        include_once __DIR__ . "/../model/add_wright_off.php";

        addWrightOff($data['transactions'], $data['number']);

    }

    function doc_accept($data) {

        include_once __DIR__ . "/../model/add_accept.php";
        addAccept($data['transactions'], $data['number']);
        
    }