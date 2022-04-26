<?php

$counter = 0;

function increment() {
  global $counter;
  $counter++;

  return $counter;
}

increment(); // increments the value of the counter variable

echo $counter; // outputs 1
