<?php

define('NUMBERS', [1, 2, 3, 4, 5]);

function evenFilter(int $val): bool
{
  return $val % 2 == 0;
}

$result = array_filter(NUMBERS, 'evenFilter');

print_r($result);
