<?php

require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../add-recursive.php';

use function Chemem\Bingo\Functional\trampoline;

$add = trampoline('addRecursive');

var_dump($add(5));
