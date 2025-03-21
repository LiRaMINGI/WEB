<?php
function increaseEnthusiasm($string): string
{
    return $string . "!";
}
echo increaseEnthusiasm("HOLIDAYS") . "\n";

function repeatThreeTimes($string): string
{
    return $string . $string . $string;
}
echo repeatThreeTimes("REPEAT?") . "\n";

echo increaseEnthusiasm(repeatThreeTimes("TEST")) . "\n";

function cut($string, $length = 10): string
{
    return substr($string, 0, $length);
}

echo cut("ewofvhefuhpwerhg1234owrvpoeajlmkdk13456fipqew") . "\n";

function printArrayRecursively(array $array): void {
    if(empty($array)) {
        return;
    }

    echo array_shift($array) . "\n";
    printArrayRecursively($array);
}
printArrayRecursively([1,2,3,4,5,6,7,8,9]);

function sumDigitsToOneDigit(int $number): int {
    while ($number > 9) {
        $number = array_sum(str_split((string) $number));
    }
    return $number;
}
echo sumDigitsToOneDigit(54321) . "\n";