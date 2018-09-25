<?php

require __DIR__ . '/vendor/autoload.php';

use function Chemem\Bingo\Functional\Algorithms\trampoline;

const map = 'map';

function map(callable $func, array $list, int $count = 0, array $acc = []) : array
{
    $listCount = count($list);

    if ($count >= $listCount) {
        return $acc;
    }

    $acc[] = $func($list[$count]);

    return map($func, $list, $count + 1, $acc);
}

map(function (int $val) { return pow($val, 2); }, range(1, 5));

$opMap = trampoline('map');

$opMap(function (int $val) { return pow($val, 2); }, range(1, 5));