<?php

require __DIR__ . '/vendor/autoload.php';

use Chemem\Bingo\Functional\Functors\Monads\IO;
use function Chemem\Bingo\Functional\Algorithms\compose;

const fileInit = 'fileInit';

function fileInit(string $file) : IO
{
    return IO::of($file);
}

const read = 'read';

function read(IO $file) : IO
{
    return $file
        ->map('file_get_contents')
        ->map('strtoupper');
}

$read = compose(fileInit, read);

var_dump($read('file.txt'));