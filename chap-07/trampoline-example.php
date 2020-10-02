<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/map-recursive.php';

use function Chemem\Bingo\Functional\Algorithms\trampoline;

$opm = trampoline('mapRecursive');

var_dump($opm(fn (int $x): int => $x ** 2, range(1, 5)));
