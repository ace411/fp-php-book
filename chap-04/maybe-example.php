<?php

require __DIR__ . '/vendor/autoload.php';

use Chemem\Bingo\Functional\Functors\Maybe;
use Chemem\Bingo\Functional\Functors\Monads as M;

function addTen(int $val) : Maybe\Maybe
{
    return M\bind(function (int $val) {
        return M\bind(
            function (int $val) {
                return Maybe\Just::of($val + 10);
            }, 
            Maybe\Just::of($val)
                ->filter(function ($val) {
                    return $val > 20;
                })
        );
    }, Maybe\Maybe::fromValue($val));
}

print_r(addTen(30));
print_r(addTen(12));