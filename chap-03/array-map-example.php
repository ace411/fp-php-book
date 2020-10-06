<?php

require __DIR__ . '/functions.php';
require __DIR__ . '/state.php';

$result = array_map('factorial', NUMBERS);

print_r($result);
