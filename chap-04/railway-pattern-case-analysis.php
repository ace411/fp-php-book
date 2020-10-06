<?php

require __DIR__ . '/vendor/autoload.php';

use Chemem\Bingo\Functional\{
  Functors\Either,
  Algorithms as f,
};
use function Chemem\Bingo\Functional\Functors\Either\either;

function addTen(int $val): int
{
  return either(
    f\identity,
    fn (int $x): int                                     => $x + 10,
    Either\Either::right($val)->filter(fn (int $x): bool => $x > 20, 0)
  );
}

function squareCubeRoot(int $val): int
{
  return either(
    f\identity,
    fn (int $x): int => $x ** 2,
    Either\Either::right($val)
      ->filter((fn (int $x): bool => !is_float((int) ($x ** (1 / 3)))), 0)
  );
}

$res = f\compose('addTen', 'squareCubeRoot')(54);

echo $res;
