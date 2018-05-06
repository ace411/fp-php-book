<?php

require __DIR__ . '/vendor/autoload.php';

const add = 'add';

function add(int $valX, int $valY, int $valZ) : int
{
    return $valX + $valY + $valZ;
}

$partial = Chemem\Bingo\Functional\Algorithms\partialLeft(add, 1, 2);

echo $partial(4);