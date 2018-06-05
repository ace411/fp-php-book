<?php

require __DIR__ . '/vendor/autoload.php';

use function Chemem\Bingo\Functional\Algorithms\compose;

const PHRASE = 'functional programming rocks';

$replace = function (string $phrase) : string {
    return preg_replace('/\s+/', '_', $phrase);
};

$composed = compose($replace, 'strtoupper');

echo $composed(PHRASE);