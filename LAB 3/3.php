<?php
$num_languages = 4;     // Языки
$month = 11;    // Месяцы
$days = $month * 16; // Дни
$days_per_language = $days / $num_languages;
echo 'ответ: ', $days_per_language, "\n";