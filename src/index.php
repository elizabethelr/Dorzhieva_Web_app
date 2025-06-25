<?php
session_start();
// Если пользователь авторизован, отправляем на страницу приветствия, иначе - на страницу входа
if (isset($_SESSION['user_id'])) {
    header('Location: welcome.php');
} else {
    header('Location: login.php');
}
exit();
?>

