<?php

require __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/acme.php';

use Acme;
use Chemem\Bingo\Functional as f;

if ((float) phpversion() < 8.1) {
  exit();
}

// Acme\hyphenate(...) is mostly equivalent to fn (...$args) => Acme\hyphenate(...$args);
$chain = f\compose(Acme\hyphenate(...), 'strtoupper');

echo $chain(['foo', 'bar']);
