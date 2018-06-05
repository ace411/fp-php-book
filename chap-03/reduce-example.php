<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/functions.php';
require __DIR__ . '/state.php';

use function Chemem\Bingo\Functional\Algorithms\reduce;

$result = reduce(
    minVal, 
    EVEN_NUMBERS, 
    array_values(EVEN_NUMBERS)[0]
);

echo $result;