<?php

require __DIR__ . '/vendor/autoload.php';

const PHRASE = 'functional programming rocks';

$replace = function (string $phrase) : string {
    return preg_replace('/\s+/', '_', $phrase);
};

$composed = Chemem\Bingo\Functional\Algorithms\compose($replace, 'strtoupper');

echo $composed(PHRASE);