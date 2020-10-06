<?php

require __DIR__ . '/functions.php';
require __DIR__ . '/state.php';

$result = array_merge(
  ...array_map(
    fn (string $key, int $value): array => [$key => factorial($value)],
    FACT_KEYS,
    NUMBERS
  )
);

print_r($result);
