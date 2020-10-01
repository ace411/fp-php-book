<?php

require __DIR__ . '/functions.php';
require __DIR__ . '/state.php';

$result = array_filter(NUMBERS, 'evenFilter');

print_r($result);
