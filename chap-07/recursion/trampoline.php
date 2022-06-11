<?php

require __DIR__ . '/../vendor/autoload.php';
require_once 'map.php';

use function Chemem\Bingo\Functional\trampoline;

$opm = trampoline('mapRecursive');

var_dump($opm(fn (int $x): int => $x ** 2, range(1, 5)));
