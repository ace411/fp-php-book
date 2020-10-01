<?php

function headWithDefault(array $numbers, $default = 1)
{
  return isset($numbers[0]) ? $numbers[0] : $default;
}

headWithDefault([
  'foo' => 13,
  'bar' => 17,
]);
