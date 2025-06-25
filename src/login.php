<?php
session_start();
require 'db.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // !!! ВНИМАНИЕ: УЯЗВИМОСТЬ К SQL-ИНЪЕКЦИИ !!!
    // Запрос формируется путем конкатенации строк, что позволяет внедрить вредоносный SQL-код.
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $stmt = $pdo->query($sql);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Устанавливаем сессию для авторизации
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        
        // 3. Реализация Cookie (2 балла)
        setcookie("username", $user['username'], time() + (86400 * 30), "/"); // cookie на 30 дней
        
        header('Location: welcome.php');
        exit();
    } else {
        $error = 'Неверное имя пользователя или пароль.';
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="form-container">
        <h2>Авторизация</h2>
        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <?php if (isset($_GET['registered'])): ?>
            <p class="success">Регистрация прошла успешно! Теперь вы можете войти.</p>
        <?php endif; ?>
        <form method="post">
            <input type="text" name="username" placeholder="Имя пользователя" required>
            <input type="password" name="password" placeholder="Пароль" required>
            <button type="submit">Войти</button>
        </form>
        <a href="registration.php">Нет аккаунта? Зарегистрироваться</a>
    </div>
</body>
</html>

