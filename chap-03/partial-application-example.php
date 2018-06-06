<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/functions.php';

use function Chemem\Bingo\Functional\Algorithms\partial;

$partial = partial(multipleOp, 12);

$final = $partial(13, '5');

echo $final;