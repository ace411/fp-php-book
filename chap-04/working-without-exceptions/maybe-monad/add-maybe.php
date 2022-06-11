<?php

require __DIR__ . '/../../vendor/autoload.php';

use Chemem\Bingo\Functional\Functors\{
  Monads as m,
  Monads\Maybe
};

function addTen(int $val): Maybe
{
  return m\bind(
    fn (int $x) => Maybe::just($x + 10),
    Maybe::fromValue($val)
      ->filter(fn (int $x): bool => $x > 20)
  );
}

print_r(addTen(30));
print_r(addTen(12));
