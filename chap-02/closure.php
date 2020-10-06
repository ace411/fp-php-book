<?php

$divisor = 4;

$divide = function (int $dividend) use ($divisor) : int {
  return $dividend / $divisor;
};

$divide(12);
