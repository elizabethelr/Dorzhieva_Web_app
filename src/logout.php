<?php
session_start();

// Уничтожаем сессию
session_unset();
session_destroy();

// Удаляем cookie, устанавливая время жизни в прошлом
setcookie('username', '', time() - 3600, "/");

header('Location: login.php');
exit();
?>
