<?php

require __DIR__ . '/vendor/autoload.php';

use Chemem\Bingo\Functional\Functors\Monads as M;
use Chemem\Bingo\Functional\Functors\Monads\ListMonad;

$zipList = function () : ListMonad {
    return M\bind(function ($val) {
        return ListMonad\fromValue(pow($val, 2));
    }, ListMonad\fromValue(range(1, 5)));
};

print_r($zipList()->extract());