<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/functions.php';
require __DIR__ . '/state.php';

use function Chemem\Bingo\Functional\Algorithms\filter;

$result = filter('evenFilter', NUMBERS);

print_r($result);
