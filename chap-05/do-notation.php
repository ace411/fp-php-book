<?php

require __DIR__ . '/vendor/autoload.php';

use Widmogrod\Monad\Identity;
use function Widmogrod\Monad\Control\Doo\{doo, let, in};

$eval = doo(
	let('a', Identity::of(1)),
	let('b', Identity::of(2)),
	let('c', in(['a', 'b'], fn (int $a, int $b): Identity => (
		Identity::of($a * $b)
	))),
	in(['c'], fn (int $c): Identity => Identity::of($c))
);

echo $eval->extract();
