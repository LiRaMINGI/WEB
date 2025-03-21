<?php
function Func1($num1, $num2): int|float
{
    return ($num1 + $num2) > 10;
}
echo Func1(7, 9);

function Equal($num1, $num2)
{
    return $num1 === $num2;
}
echo Equal(76, 76), "\n";

$test = 0;
echo ($test == 0) ? 'верно' : '', "\n";

$age = 19;
if ($age < 10 || $age > 99) {
    echo "число меньше 10 или больше 99\n";
} else {
    $summa = array_sum(str_split((string)$age));
    if ($summa <= 9) {
        echo "сумма однозначна\n";
    } else {
        echo "сумма двузначна\n";
    }
}

$array = [1, 2, 3];
if (count($array) == 3) {
    echo "сумма: " . array_sum($array) . "\n";
}