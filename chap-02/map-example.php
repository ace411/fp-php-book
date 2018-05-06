<?php

require __DIR__ . '/vendor/autoload.php';

const EVEN_NUMBERS = [2, 4, 6, 8];

const multiply = 'multiply';

function multiply(int $number) : int
{
    return $number * 2;
}

$multiplesMap = Chemem\Bingo\Functional\Algorithms\map(multiply, EVEN_NUMBERS);

$multiplesArrMap = array_map(multiply, EVEN_NUMBERS);

var_dump($multiplesMap == $multiplesArrMap);