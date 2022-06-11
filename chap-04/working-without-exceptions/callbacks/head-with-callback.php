<?php

function head(array $numbers, callable $callback)
{
  return isset($numbers[0]) ? $numbers[0] : $callback($numbers);
}

echo head(['foo' => 12, 'bar' => 15], 'reset'); // prints 12
