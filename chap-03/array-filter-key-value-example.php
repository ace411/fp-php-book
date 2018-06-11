<?php

define('FACTORIAL', ['1!' => 1, '2!' => 2, '3!' => 6, '4!' => 24, '5!' => 120]);

$result = array_filter(
    FACTORIAL,
    function (int $value, string $key) {
        return $value > 24 || $key == '2!';
    },
    ARRAY_FILTER_USE_BOTH
);

print_r($result);