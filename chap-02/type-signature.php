<?php

/**
 * add :: String -> Int -> Int
 */
function add(string $x, int $y): int
{
  return mb_strlen($x, 'utf-8') + $y;
}
