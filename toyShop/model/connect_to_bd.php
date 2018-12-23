<?php ## Обработка ошибки соединения с базой данных
try {
    $pdo = new PDO(
        'mysql:host=109.95.210.219;dbname=u47513;charset=utf8',
        'u47513_rabbik',
        'Dtytnfhbq666',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

}
catch (PDOException $e) {
    echo "Невозможно установить соединение с базой данных";
}

