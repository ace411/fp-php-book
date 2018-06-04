<?php

require __DIR__ . '/functions.php';
require __DIR__ . '/state.php';

$result = array_reduce(
    EVEN_NUMBERS,
    minVal,
    array_values(EVEN_NUMBERS)[0]
);

echo $result;