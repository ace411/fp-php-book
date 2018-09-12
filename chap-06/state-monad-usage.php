<?php

require __DIR__ . '/vendor/autoload.php';

use Chemem\Bingo\Functional\{
    Algorithms as A,
    Functors\Monads\State
};

const USERS = [
    'peter',
    'jackson',
    'anderson',
    'wesley',
    'pierce'
];

list($orig, $new) = State::of(USERS)
    ->map(A\partialRight(A\extend, ['keanu', 'johnson']))
    ->flatMap(A\unique);