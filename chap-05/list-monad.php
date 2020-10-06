<?php

require __DIR__ . '/vendor/autoload.php';

use Chemem\Bingo\Functional\Functors\{
  Monads as m,
  Monads\ListMonad
};

$zipList = fn (): ListMonad => (
  m\bind(
    fn ($val) => ListMonad\fromValue(pow($val, 2)),
    ListMonad\fromValue(range(1, 5))
  )
);

print_r($zipList()->extract());
