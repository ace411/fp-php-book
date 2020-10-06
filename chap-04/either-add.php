<?php

require __DIR__ . '/vendor/autoload.php';

use Chemem\Bingo\Functional\Functors\{
	Either,
	Monads as m
};

function addTen(int $val): Either\Either
{
  return m\bind(
		fn (int $x) => Either\Either::right($x + 10),
		Either\Either::right($val)
			->filter(fn (int $x): bool => $x > 20, 'less than 20')
	);
}

print_r(addTen(30));
print_r(addTen(12));
