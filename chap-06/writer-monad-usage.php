<?php

require __DIR__ . '/vendor/autoload.php';

use Chemem\Bingo\Functional\{
    Algorithms as A,
    Functors\Monads\IO,
    Functors\Monads\Writer
};

$logger = function () : Writer {
    return Writer\writer(5, 'put 5 in Writer')
        ->bind(function ($val) {
            return Writer\writer(null, 'add 2')
                ->map(function ($result) use ($val) {
                    return $result + ($val + 2);
                });
        });
};

$output = Writer\execWriter($logger());

print_r($output);