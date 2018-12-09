
<!-- Верхний блок с навигацией -->
<div id="header-top-block">
    <!-- Список с навигацией -->
    <ul id="header-top-menu">
        <li><a href="o-nas.php">О нас</a></li>
        <li><a href="feedback.php">Контакты</a></li>
        <li><a href="sertificate.php">Сертификаты</a> </li>
    </ul>
    <!-- Вход и регистрация -->
    <!-- Блок Авторизация -->
    <?php
    if ($_SESSION['auth'] == 'yes_auth')
    {
        echo '<p id="auth-user-info" align="right"><img src="images/user.png" />Здравствуй, '.$_SESSION['login'].'</p>';
    } else{
        echo '<p id="reg-auth-title" align="right"><a class="top-auth" id="">Вход</a></p>';
    }
    ?>

    <div id="block-top-auth">
        <div class="corner"></div>
        <form method="POST" action="">
            <ul id="input-email-pass">
                <h3>Вход</h3>
                <p id="message-auth">Неверный Логин и(или) Пароль</p>
                <li>
                    <center>
                        <input type="text" id="auth_login" placeholder="Логин или E-mail">
                    </center>
                </li>
                <li>
                    <center>
                        <input type="password" id="auth_pass" placeholder="Пароль">
                        <span id="button-pass-show-hide" class="pass-show"></span>
                    </center>
                </li>

                <p align="right" id="button-auth"><a>Вход</a></p>
                <p align="right" class="auth-loading"><img src="images/loading.gif"></p>
            </ul>
        </form>

    </div>


</div>
<!-- Линия -->
<hr class="top-line"/>
<!-- Авторизированный пользователь -->
<div id="block-user" >
    <div class="corner2"></div>
    <ul>
        <li><img src="images/user_info.png" /><a href="profile.php">Управление</a></li>
        <li><img src="images/logout.png" /><a id="logout" >Выход</a></li>
    </ul>
</div>

</div>
