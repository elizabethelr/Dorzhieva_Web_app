<?php
session_start();

// 4. Доступ только после авторизации
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Имя пользователя берется из сессии (безопаснее) или из cookie
$username = htmlspecialchars($_SESSION['username']);
$cookie_username = isset($_COOKIE['username']) ? htmlspecialchars($_COOKIE['username']) : 'не найден';

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добро пожаловать!</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="welcome-container">
        <h1>Привет, <?php echo $username; ?>!</h1>
        <p>Вы успешно авторизованы.</p>
        <a href="logout.php">Выйти</a>
    </div>
</body>
</html>
