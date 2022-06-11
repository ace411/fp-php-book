<?php

require __DIR__ . '/../../vendor/autoload.php';

use Chemem\Bingo\Functional as f;

define('NUMBERS', [1, 2, 3, 4, 5]);

function factorial(int $val): int 
{
  return $val < 2 ? 1 : factorial($val - 1) * factorial($val);
}

$result = f\map('factorial', NUMBERS);

print_r($result);
