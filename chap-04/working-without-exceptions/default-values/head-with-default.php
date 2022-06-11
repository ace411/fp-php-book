<?php

function headWithDefault(array $numbers, $default = 1)
{
  return isset($numbers[0]) ? $numbers[0] : $default;
}

var_dump(
  headWithDefault(
    [
      'foo' => 13,
      'bar' => 17
    ]
  )
);