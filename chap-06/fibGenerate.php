<?php

$fib = function (int $val) use (&$fib): int {
  return $val < 2 ? $val : $fib($val - 1) + $fib($val - 2);
};

function fibGenerate(int $start, int $end): string
{
  global $fib;
  $results = array_map($fib, range($start, $end));

  return json_encode($results, JSON_PRETTY_PRINT);
}
