<?php

require __DIR__ . '/../../vendor/autoload.php';

use function Chemem\Bingo\Functional\filter;

define('NUMBERS', [1, 2, 3, 4, 5]);

function evenFilter(int $val): bool
{
  return $val % 2 == 0;
}

$result = filter('evenFilter', NUMBERS);

print_r($result); // [2, 4]
