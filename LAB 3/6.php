<?php
echo "Работа с %\n";
$a = 10;
$b = 3;
echo $a % $b, "\n";

$a = fgets(STDIN);
$b = fgets(STDIN);
if ($a % $b == 0) {
    echo "делится", $a / $b, "\n";
} else {
    echo "делится с остатком ", $a % $b, "\n";
}

$st = pow(2, 10);
$sr = sqrt(245);

$array = array(4, 2, 5, 19, 13, 0, 10);
$summa = 0;
foreach ($array as $value) {
    $summa += $value**2;
}

echo "1. 2^10 = ", $st,
"\n2. 245^(1/2) = ", $sr,
"\n3. Корень из суммы квадратов: ", sqrt($summa), "\n";

$ch1 = sqrt(379);
$A = round($ch1);
$B = round($ch1, 1);
$C = round($ch1, 2);

$ch2 = sqrt(587);
$array = ['floor' => floor($ch2), 'ceil' => ceil($ch2)];

echo "Результаты округления корня из числа 379:",
"\n$A", "\n$B", "\n$C";
echo "\nРезультат округления корня из числа 587: ";
var_dump($array);

$array = [4, -2, 5, 19, -130, 0, 10];
echo "минимальное: ", min($array),
"\nмаксимальное: ", max($array), "\n";


echo rand(1, 100), "\n";

$array = [];
for ($i = 0; $i < 10; $i++) {
    $array[$i] = rand(1, 100);
}
var_dump($array);

$a = 68;
$b = 104;
echo '(a - b) = ', abs($a - $b);
echo "\n(b - a) = ", abs($b - $a), "\n";

$array = [1, 2, -1, -2, 3, -3];
$newArray = array_map('abs', $array);
var_dump($newArray);


echo "введите число: ";
$a = fgets(STDIN);

$arrayDivisor = [];
for ($d = 1; $d <= $a/2; $d++) {
    if ($a % $d == 0) {
        $arrayDivisor[] = $d;
    }
}

$arrayDivisor[] = intval($a);
echo "делители числа {$a}:\n";
var_dump($arrayDivisor);

$array = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
$summa = 0;
$count = 0;
foreach ($array as $value) {
    if ($summa <= 10) {
        $summa += $value;
        $count++;
    }
}
echo "чтобы summa>10, надо сложить первые {$count} чисел.";
