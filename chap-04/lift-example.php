<?php

require __DIR__ . '/vendor/autoload.php';

use Chemem\Bingo\Functional\Functors\Either;

$lifted = Either\Either::lift(function (int $x, int $y) : int {
    return $x - $y;
}, Either\Either::left('operation error'));

print_r($lifted(Either\Either::right(3), Either\Either::left(2)));