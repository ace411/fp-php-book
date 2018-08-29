<?php

require __DIR__ . '/vendor/autoload.php';

use function Chemem\Bingo\Functional\Algorithms\trampoline;

$fib = trampoline(function (int $val) use (&$fib) { return $val < 2 ? $val : $fib($val - 1) + $fib($val - 2); });

echo $fib(10);