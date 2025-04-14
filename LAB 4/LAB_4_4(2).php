<?php
session_start();
if (!isset($_SESSION['user'])) {
    die('Данные не найдены');
}


$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Профиль</title>
</head>
<body>
<h2>Ваши данные:</h2>
<p>Название компании: <?= $user['company'] ?></p>
<p>Должность: <?= $user['status'] ?></p>
<p>Зарплата: <?= $user['salary'] ?></p>

<p><a href="index.php">Вернуться</a></p>
</body>
</html>