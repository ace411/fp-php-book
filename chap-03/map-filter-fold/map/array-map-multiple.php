<?php

define('NUMBERS', [1, 2, 3, 4, 5]);

define('FACT_KEYS', ['1!', '2!', '3!', '4!', '5!']);

function factorial(int $val): int 
{
  return $val < 2 ? 1 : factorial($val - 1) * factorial($val);
}

$result = array_merge(
  ...array_map(
    fn (string $key, int $value): array => [$key => factorial($value)],
    FACT_KEYS,
    NUMBERS
  )
);

print_r($result);
