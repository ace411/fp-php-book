<?php

$divisor = 4;

$divide = function (int $dividend) use ($divisor) : int {
  return $dividend / $divisor;
};

echo $divide(12);
