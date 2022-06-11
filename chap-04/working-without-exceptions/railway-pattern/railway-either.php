<?php

require __DIR__ . '/../../vendor/autoload.php';

use Chemem\Bingo\Functional\Functors\Monads\Either;

function addTen(int $val): Either\Either
{
  return Either\Either::right($val)
    ->filter(fn (int $x): bool => $x > 20, 0)
    ->map(fn (int $x)          => $x + 10);
}

function squareCubeRoot(int $val): Either\Either
{
  return Either\Either::right($val)
    ->filter(fn (int $x): bool => !is_float((int) ($x ** (1 / 3))), 0)
    ->map(fn (int $x): int     => $x ** 2);
}

$res = addTen(54)
  ->bind('squareCubeRoot')
  ->map('var_dump');
