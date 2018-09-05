<?php

require __DIR__ . '/vendor/autoload.php';

use function FunctionalPHP\PatternMatching\match;

$match = match(
    [
        '[_, "chemem"]' => function () { return 'chemem'; },
        '_' => function () { return 'NaN'; }
    ],
    explode('/', 'api/chemem')
);
