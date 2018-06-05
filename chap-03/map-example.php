<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/functions.php';
require __DIR__ . '/state.php';

use function Chemem\Bingo\Functional\Algorithms\map;

$result = map(factorial, NUMBERS);

print_r($result);