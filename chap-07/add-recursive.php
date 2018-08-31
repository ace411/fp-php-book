<?php

require __DIR__ . '/vendor/autoload.php';

use function Chemem\Bingo\Functional\Algorithms\trampoline;

function addRecursive(int $num, int $count = 0, array $acc = [], bool $continue = true) : array
{
    if (!$continue) {
        return $acc;
    }

    $acc[] = $count + $num;

    return addRecursive($num, $count + 1, $acc, $count < $num);
}

$add = trampoline('addRecursive');

var_dump($add(5));