<?php
$upperCount = 0;
$lowerCount = 0;
$inputText = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputText = $_POST['text'] ?? '';
    
    if (!empty($inputText)) {
        // Подсчет заглавных букв (A-Z)
        preg_match_all('/[A-ZА-ЯЁ]/u', $inputText, $upperMatches);
        $upperCount = count($upperMatches[0] ?? []);
        
        // Подсчет строчных букв (a-z)
        preg_match_all('/[a-zа-яё]/u', $inputText, $lowerMatches);
        $lowerCount = count($lowerMatches[0] ?? []);
    }
}
?>

<!DOCTYPE html>
<html>
<body>
<form method="POST">
    <textarea name="text" rows="4" cols="50"><?= htmlspecialchars($inputText) ?></textarea>
    <br>
    <button type="submit">Посчитать</button>
</form>

<?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
    <p>Заглавных букв: <?= $upperCount ?></p>
    <p>Строчных букв: <?= $lowerCount ?></p>
<?php endif; ?>
</body>
</html>