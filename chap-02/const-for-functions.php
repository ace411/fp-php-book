<?php

require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/acme.php';

use Chemem\Bingo\Functional\Algorithms as f;

$chain = f\compose(Acme\hyphenate, 'strtoupper');

echo $chain(['foo', 'bar']);
