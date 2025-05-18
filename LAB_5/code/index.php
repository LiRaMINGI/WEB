<?php
$categories = ['Auto', 'Moto', 'Bikes'];
foreach ($categories as $category) {
    if (!file_exists("categories/$category")) {
        mkdir("categories/$category", 0777, true);
    }
}

// обработка
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars($_POST['email']);
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $category = $_POST['category'];

    // очищаем название от спецсимволов
    $clean_title = preg_replace('/[^a-z0-9]/ui', '_', $title);
    $filename = "categories/$category/$clean_title.txt";

    // да перезаписываем потом
    if (file_exists($filename)) {
        $filename = "categories/$category/{$clean_title}_copy.txt";
    }

    file_put_contents($filename, "Email: $email\nTitle: $title\nDescription: $description");
}

// все объявления
$ads = [];
foreach ($categories as $category) {
    $files = glob("categories/$category/*.txt");
    foreach ($files as $file) {
        $content = file_get_contents($file);
        $lines = explode("\n", $content);

        $ads[] = [
            'email' => str_replace('Email: ', '', $lines[0]),
            'title' => str_replace('Title: ', '', $lines[1]),
            'description' => str_replace('Description: ', '', $lines[2]),
            'category' => $category
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="">
<head>
    <title>доска</title>
</head>
<body>

<form method="post">
    email: <input type="email" name="email"><br>
    заголовок: <input type="text" name="title"><br>
    категория:
    <select name="category">
        <option>Auto</option>
        <option>Moto</option>
        <option>Bikes</option>
    </select><br>
    описание: <label>
        <textarea name="description"></textarea>
    </label><br>
    <button>добавить</button>
</form>

<h3>объявления:</h3>
<table>
    <tr>
        <td><b>email</b></td>
        <td><b>заголовок</b></td>
        <td><b>описание</b></td>
        <td><b>категория</b></td>
    </tr>
    <?php foreach ($ads as $ad): ?>
        <tr>
            <td><?=$ad['email']?></td>
            <td><?=$ad['title']?></td>
            <td><?=$ad['description']?></td>
            <td><?=$ad['category']?></td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>