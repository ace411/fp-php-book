<?php

require __DIR__ . '/functions.php';
require __DIR__ . '/state.php';

$result = array_merge(
    ...array_map(
        function (string $key, int $value) : array {
            return [$key => factorial($value)];
        },
        FACT_KEYS,
        NUMBERS
    )
);

print_r($result);