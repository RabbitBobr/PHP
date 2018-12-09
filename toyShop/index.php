<?php session_start(); ?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">

    <title>Учет товарооборота</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/reset.css">

    <script type="text/javascript" src="js/jq.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
    <script type="text/javascript" src="js/jquery.cookie.min.js"></script>

</head>
<body>
    <div id="block-body">
        <div id="block-header">
            <?php
                include "include/block_header.php";
            ?>
        </div>

        <div id="block-content">
            <?php
            include "include/block_content.php";
            ?>
        </div>

        <div id="block-right">
            <?php
            include "include/block_right.php";
            ?>
        </div>

        <div id="block-footer">
            <?php
            include "include/block_footer.php";
            ?>
        </div>
    </div>
</body>
</html>