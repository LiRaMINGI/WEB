<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Сохраняем данные в сессию
    $_SESSION['user'] = [
        'company' => htmlspecialchars($_POST['company']),
        'status' => htmlspecialchars($_POST['status']),
        'salary' => htmlspecialchars($_POST['salary'])
    ];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ввод данных</title>
</head>
<body>
<form method="POST">
    <label>Название компании:</label>
    <input type="text" name="company" required><br>

    <label>Должность:</label>
    <input type="text" name="status" required><br>

    <label>Зарплата:</label>
    <input type="number" name="salary" required><br>

    <button type="submit">Сохранить</button>
</form>

<p><a href="profile.php">Перейти к профилю</a></p>
</body>
</html>