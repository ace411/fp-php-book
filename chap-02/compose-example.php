<?php

require __DIR__ . '/vendor/autoload.php';

use Chemem\Bingo\Functional\Algorithms as f;

$compose = f\compose(
  f\partialLeft('str_replace', '-', ''),
  'strtoupper'
);

var_dump($compose('F-P is cool'));
