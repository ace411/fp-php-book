<?php

require __DIR__ . '/vendor/autoload.php';

use Widmogrod\Monad\Identity;
use function Widmogrod\Monad\Control\Doo\{doo, let, in};

$eval = doo(
    let('a', Identity::of(1)),
    let('b', Identity::of(2)),
    let('c', in(['a', 'b'], function (int $a, int $b) : Identity { return Identity::of($a * $b); })),
    in(['c'], function (int $c) : Identity { return Identity::of($c); })
);

echo $eval->extract();