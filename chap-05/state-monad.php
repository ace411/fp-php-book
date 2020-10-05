<?php

require __DIR__ . '/vendor/autoload.php';

use Chemem\Bingo\Functional\{
  Algorithms as f,
  PatternMatching as p,
  Functors\Monads\State
};

const START_STATE = ['on' => false, 'val' => 0];

function playGame(string $txt): State
{
  return State\gets(fn (array $state) => (
    f\fold(fn (array $prevState, string $char) => (
      p\patternMatch([
        '"a"' => fn () => f\extend($prevState, [
          'on'  => true,
          'val' => $prevState['val'] + 1,
        ]),
        '"b"' => fn () => f\extend($prevState, [
          'on'  => true,
          'val' => $prevState['val'] - 1,
        ]),
        '"c"' => fn () => f\extend($prevState, [
          'on' => false,
        ]),
        '_'   => fn () => f\extend($prevState, [
          'on' => true,
        ]),
      ], $char)
    ), str_split($txt), $state)
  ));
}

print_r(State\evalState(playGame('abcaaacbbcabbab'), null)(START_STATE));
