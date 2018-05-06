<?php

require __DIR__ . '/vendor/autoload.php';

$zipped = Chemem\Bingo\Functional\Algorithms\zip(
    null, 
    [1, 2, 3], 
    ['PG', 'SG', 'SF']
);

$unzipped = Chemem\Bingo\Functional\Algorithms\unzip($zipped);