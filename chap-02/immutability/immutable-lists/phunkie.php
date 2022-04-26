<?php

require __DIR__ . '/../../../vendor/autoload.php';

use Phunkie\Types\ImmList;

$even = new ImmList([2, 4, 6, 8]);

$greaterThanFive = $even
  ->filter(fn (int $x): bool => $x > 5);

var_dump($greaterThanFive);
