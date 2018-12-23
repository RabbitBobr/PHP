<?php

    require_once "controllers/save_new_check.php";
    
    $p = file_get_contents('http://bobrstore.ru/backend/814eb4c9-d837-4551-beea-1f6c1542872d.json');
    $json_check = json_decode($p);
    //http_response_code(200);
    //file_put_contents('log.json', json_encode($p));
    
    //$_SESSION['json_evo_check'] = $p;
    //header('Location: ~/www/bobrstore.ru/backend/controllers/save_new_check.php');

    save_check($p);
