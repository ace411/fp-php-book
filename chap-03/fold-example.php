<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/functions.php';
require __DIR__ . '/state.php';

use function Chemem\Bingo\Functional\Algorithms\{head, fold};

$result = fold($min, EVEN_NUMBERS, head(EVEN_NUMBERS));

echo $result;
