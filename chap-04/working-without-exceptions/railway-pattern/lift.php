<?php

require __DIR__ . '/../../vendor/autoload.php';

use Chemem\Bingo\Functional\Functors\Monads\Either;

$subtract = fn (int $x, int $y): int => $x - $y;

$lifted   = Either\Either::lift($subtract, Either\Either::left(0));

print_r($lifted(Either\Either::right(5), Either\Either::right(3)));

print_r($lifted(Either\Either::right(3), Either\Either::left(2)));
