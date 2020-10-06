<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/calculator-functor.php';

use Chemem\Bingo\Functional\Algorithms as f;

$calc = Calculator::of(12);

$exp = fn (float $val): float => $val ** 4;

$ops = fn (float $val): float => ($val / 3) - 2.5;

// identity
echo assert(
  $calc->map(f\identity) == f\identity($calc),
  'Identity proof violation'
);

// composition
echo assert(
  $calc->map($exp)->map($ops) == $calc->map(f\compose($exp, $ops)),
  'Composition violation'
);
