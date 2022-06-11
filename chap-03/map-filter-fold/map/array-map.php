<?php

define('NUMBERS', [1, 2, 3, 4, 5]);

function factorial(int $val): int 
{
  return $val < 2 ? 1 : factorial($val - 1) * factorial($val);
}

$result = array_map('factorial', NUMBERS);

print_r($result); // prints [1, 2, 6, 24, 120]
