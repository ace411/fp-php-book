<?php

require __DIR__ . '/vendor/autoload.php';

const NUMBERS = [1, 2, 3, 4, 5, 6, 7, 8];

const filterEven = 'filterEven';

function filterEven(int $val) : bool
{
    return $val % 2 == 0;
}

$filter = Chemem\Bingo\Functional\Algorithms\filter(filterEven, NUMBERS);

$filterArrFil = array_filter(NUMBERS, filterEven);