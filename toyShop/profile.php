<?php
session_start();
if($_SESSION['auth'] == 'yes_auth')
{
    ?>
    <!doctype html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">

        <title>Управление</title>


        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/profile_steel.css">
        <link rel="stylesheet" href="css/table_style.css">

        <script type="text/javascript" src="js/jq.js"></script>
        <script type="text/javascript" src="js/index.js"></script>
        <script type="text/javascript" src="js/profile.js"></script>
        <script type="text/javascript" src="js/jquery.cookie.min.js"></script>
    </head>
    <body>
    <div id="block-body">
        <div id="block-header">
            <?php
            include "include/block_header_profile.php";
            ?>
            <p><a href="index.php">На главную</a> </p>

        </div>

        <div id="block-content">
            <?php
            include "include/profile_content.php";
            ?>
        </div>
    </div>
    </body>
    </html>

<?php
} else {
    echo "Нет доступа к данным, авторизируйтесь!";
    echo '<a href="index.php">На главную</a>';
}
?>