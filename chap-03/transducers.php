<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use Chemem\Bingo\Functional\Algorithms as f;

function mapT(callable $transform): callable
{
  return fn ($step) => fn ($acc, $val) => (
    $step($acc, $transform($val))
  );
}

function filterT(callable $predicate): callable
{
  return fn ($step) => fn ($acc, $val) => (
    $predicate($val) ? $step($acc, $val) : $acc
  );
}

$square = mapT(f\partialRight('pow', 2));

$even = filterT(fn ($val): bool => $val % 2 == 0);

$step = fn ($acc, $val) => f\extend($acc, [$val]);

\print_r(f\fold(f\compose($square, $even)($step), \range(1, 5), []));
