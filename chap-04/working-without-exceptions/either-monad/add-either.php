<?php

require __DIR__ . '/../../vendor/autoload.php';

use Chemem\Bingo\Functional\Functors\{
  Monads as m,
  Monads\Either,
};

function addTen(int $val): Either
{
  return m\bind(
    fn (int $x) => Either::right($x + 10),
    Either::right($val)
      ->filter(fn (int $x): bool => $x > 20, 'less than 20')
  );
}

print_r(addTen(30));
print_r(addTen(12));
