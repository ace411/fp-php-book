<?php

require __DIR__ . '/../../vendor/autoload.php';

use function Chemem\Bingo\Functional\{head, fold};

$min    = fn (int $start, int $val): int => $val < $start ? $val : $start;

$result = fold($min, EVEN_NUMBERS, head(EVEN_NUMBERS));

echo $result;
