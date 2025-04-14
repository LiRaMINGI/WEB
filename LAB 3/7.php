<?php
function printStringReturnNumber(): int
{
    echo "String\n";
    return 98532456;
}

$my_num = printStringReturnNumber();
echo $my_num;