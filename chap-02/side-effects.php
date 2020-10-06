<?php

$counter = 0;

function increment()
{
  global $counter;
  $counter ++;

  return $counter;
}

echo increment();

echo $counter;
