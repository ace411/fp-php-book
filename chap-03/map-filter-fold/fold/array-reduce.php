<?php

define('EVEN_NUMBERS', [98, 46, 22, 54]);

$min    = fn (int $start, int $val): int => $val < $start ? $val : $start;

$result = array_reduce(EVEN_NUMBERS, $min, array_values(EVEN_NUMBERS)[0]);

echo $result;
