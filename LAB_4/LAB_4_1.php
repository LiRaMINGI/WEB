<?php

$str = 'fhs fbd bfd daec fdtf fxeb fbbf deae fdaf';

preg_match_all('/f..f/', $str, $matches);

print_r($matches[0]);

?>