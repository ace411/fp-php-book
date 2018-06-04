<?php

require __DIR__ . '/factorial.php';
require __DIR__ . '/state.php';

$result = array_map(factorial, NUMBERS);

print_r($result);