<?php

$counter = 0;

function increment()
{
  global $counter;

  return $counter++;
}

echo increment();
