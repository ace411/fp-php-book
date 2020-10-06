<?php

require __DIR__ . '/vendor/autoload.php';

use Chemem\Bingo\Functional\Functors\{
	Maybe,
	Monads as m
};

function addTen(int $val): Maybe\Maybe
{
  return m\bind(
		fn (int $x) => Maybe\Maybe::just($x + 10),
		Maybe\Maybe::fromValue($val)
			->filter(fn (int $x): bool => $x > 20)
	);
}

print_r(addTen(30));
print_r(addTen(12));
