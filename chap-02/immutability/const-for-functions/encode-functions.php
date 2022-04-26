<?php

function square(int $x): int
{
  return $x ** 2;
}

echo assert(square(2) == ('square')(2), 'The arbitrary function calls are equal');
echo assert(intdiv(4, 2) == ('intdiv')(4, 2), 'Function calls are equal');
