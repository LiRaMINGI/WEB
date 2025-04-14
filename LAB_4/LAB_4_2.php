<?php

$str = 'a1b4c6';
$pattern = '/\d+/';
function replaceWithFactorial($matches) {
    $number = (int)$matches[0];
    $factorial = 1;
    
    //Вычисляем факториал
    for ($i = 2; $i <= $number; $i++) {
        $factorial *= $i;
    }
    
    return $factorial; //Возвращаем факториал вместо числа
}

//Заменяем все числа в строке на их факториалы
$result = preg_replace_callback($pattern, 'replaceWithFactorial', $str);

//результат
echo "Исходная строка: " . $str . "\n";
echo "Результат замены: " . $result . "\n";
?>