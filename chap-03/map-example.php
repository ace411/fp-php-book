<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/functions.php';
require __DIR__ . '/state.php';

$result = Chemem\Bingo\Functional\Algorithms\map(factorial, NUMBERS);

print_r($result);