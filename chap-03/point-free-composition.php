<?php

require __DIR__ . '/vendor/autoload.php';

use function Chemem\Bingo\Functional\Algorithms\compose;

const PHRASE = 'functional programming rocks';

$replace  = fn (string $phrase): string => preg_replace('/\s+/', '_', $phrase);

$composed = compose($replace, 'strtoupper');

echo $composed(PHRASE);
