<?php

    require_once "controllers/save_new_check.php";
    
    $p = file_get_contents('php://input');

    save_check($p);
    
    http_response_code(200);
    
?>