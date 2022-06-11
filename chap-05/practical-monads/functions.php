<?php

require __DIR__ . '/../vendor/autoload.php';

use Chemem\Bingo\Functional\Functors\{
  Monads as m,
  Maybe\Maybe,
  Monads\IO
};

$maxM = m\foldM(fn (int $acc, int $val): m\Monadic => (
  $val > $acc ? IO\IO(fn (): int => $val) : IO\IO(fn (): int => $acc)
), [8, 9, 6, 3], 0);

$evenM = m\filterM(fn (int $val): m\Monadic => (
  Maybe::fromValue($val % 2 == 0)
), range(1, 50));

$stdio = m\mcompose(IO\putStr, IO\getLine, IO\putStr);
