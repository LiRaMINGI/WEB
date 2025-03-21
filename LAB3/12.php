<?php
$numbers = [1, 2, 3, 4, 5];
$SREDARIF = array_sum($numbers) / count($numbers);
echo "avg: $SREDARIF\n";

$summa = array_sum(range(1, 100));
echo "сумма от 1 до 100: $summa\n";

$Array = [1, 25, 49, 4, 121,];
$Roots = array_map('sqrt', $Array);
print_r($Roots);

$Alp = range('a', 'z');
$numbers = range(1, 26);
$array = array_combine($Alp, $numbers);
print_r($array);

$Numbers = '1234567890';
$para = str_split($Numbers, 2);
$summa= array_sum($para);
echo "cумма пар чисел: $summa\n";