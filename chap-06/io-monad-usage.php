<?php

require __DIR__ . '/vendor/autoload.php';

use Chemem\Bingo\Functional\Functors\Monads as M;
use Chemem\Bingo\Functional\Functors\Monads\IO;
use function Chemem\Bingo\Functional\Algorithms\compose;

$read = M\mcompose(IO\IO, IO\readFile);

$fileContents = M\bind(function ($contents) {
    $res = compose('strtoupper', IO\IO);
    return $res($contents);
}, $read(IO\IO('file.txt')));

print_r($fileContents->exec());