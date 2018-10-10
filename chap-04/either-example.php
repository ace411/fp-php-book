<?php

require __DIR__ . '/vendor/autoload.php';

use Chemem\Bingo\Functional\Functors\Either;
use Chemem\Bingo\Functional\Functors\Monads as M;

function addTen(int $val) : Either\Either
{
	return M\bind(function (int $val) {
		return M\bind(function ($val) {
			return Either\Either::right($val + 10);
		}, Either\Either::right($val)
			->filter(function ($val) {
				return $val > 20;
			}, 'less than 20'));
	}, Either\Either::right($val));
}

print_r(addTen(12));