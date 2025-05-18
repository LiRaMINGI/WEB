<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Результаты анализа</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .result {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #4CAF50;
            background-color: #f0f8f0;
        }
        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
        }
        .back-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Результаты подсчета букв</h1>
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["text"])) {
        $text = $_POST["text"];
        $upperCount = 0;
        $lowerCount = 0;

        for ($i = 0; $i < mb_strlen($text, 'UTF-8'); $i++) {
            $char = mb_substr($text, $i, 1, 'UTF-8');
            if (mb_ereg_match('[A-ZА-ЯЁ]', $char)) {
                $upperCount++;
            } elseif (mb_ereg_match('[a-zа-яё]', $char)) {
                $lowerCount++;
            }
        }
        
        echo "<div class='result'>";
        echo "<p><strong>Введенный текст:</strong></p>";
        echo "<p>" . nl2br(htmlspecialchars($text)) . "</p>";
        echo "<p><strong>Заглавных букв:</strong> $upperCount</p>";
        echo "<p><strong>Строчных букв:</strong> $lowerCount</p>";
        echo "</div>";
    } else {
        echo "<div class='result'>";
        echo "<p>Вы не ввели текст для анализа.</p>";
        echo "</div>";
    }
    ?>
    
    <a href="index.html" class="back-btn">Вернуться назад</a>
</body>
</html>