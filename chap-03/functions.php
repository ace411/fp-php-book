<?php

function factorial(int $val): int
{
  return $val < 2 ? 1 : factorial($val - 1) * $val;
}

function evenFilter(int $val): bool
{
  return $val % 2 == 0;
}

function multipleOp(int $x, int $y, string $z): int
{
  return is_numeric($z) ? ($x + $y) / $z : $x + $y;
}

$min = fn (int $start, int $value): int => $value < $start ? $value : $start;
