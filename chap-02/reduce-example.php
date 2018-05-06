<?php

require __DIR__ . '/vendor/autoload.php';

const NUMBERS = [1, 2, 3, 4];

const reduceFn = 'reduceFn';

function reduceFn(int $acc, int $val) : int
{
    return $acc + $val;
}

$reduce = Chemem\Bingo\Functional\Algorithms\reduce(reduceFn, NUMBERS, 0);

$reduceArrRed = array_reduce(NUMBERS, reduceFn, 0);

var_dump($reduce == $reduceArrRed);