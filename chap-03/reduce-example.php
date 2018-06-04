<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/functions.php';
require __DIR__ . '/state.php';

$result = Chemem\Bingo\Functional\Algorithms\reduce(
    minVal, 
    EVEN_NUMBERS, 
    array_values(EVEN_NUMBERS)[0]
);

echo $result;