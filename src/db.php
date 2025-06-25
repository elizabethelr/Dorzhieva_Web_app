<?php
$host = 'db'; // Имя сервиса базы данных из docker-compose
$dbname = 'webapp_db';
$user = 'webapp_user';
$pass = 'userpassword';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}
?>
