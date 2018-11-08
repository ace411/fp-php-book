<?php

require __DIR__ . '/vendor/autoload.php';

use Chemem\Bingo\Functional\{
    Algorithms as A,
    PatternMatching as PM,
    Functors\Monads\State
};

const START_STATE = ['on' => false, 'val' => 0];

function playGame(string $txt) : State
{
    $put = function (array $state) use ($txt) {
        return A\fold(function ($acc, string $val) {
            return PM\patternMatch(
                [
                    '"a"' => function () use ($acc) { return A\extend($acc, ['on' => true, 'val' => $acc['val'] + 1]); },
                    '"b"' => function () use ($acc) { return A\extend($acc, ['on' => true, 'val' => $acc['val'] - 1]); },
                    '"c"' => function () use ($acc) { return A\extend($acc, ['on' => false]); },
                    '_' => function () use ($acc) { return A\extend($acc, ['on' => true]); }
                ],
                $val
            );
        }, str_split($txt), $state);
    };
    return State\gets($put);
}

var_dump(State\evalState(playGame('abcaaacbbcabbab'), null)(START_STATE));