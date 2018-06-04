<?php

require __DIR__ . '/vendor/autoload.php';

use Chemem\Bingo\Functional\Algorithms as A;

const wordSplit = 'wordSplit';

function wordSplit(string $text) : array
{
    return str_split($text, 1);
}

const replaceSpaces = 'replaceSpaces';

function replaceSpaces(string $text) : string
{
    return str_replace(' ', '_', $text);    
}

const arrToString = 'arrToString';

function arrToString(array $strings) : string
{
    return implode('_', $strings);
}

$func = function (string $txt, string $mTxt) : string {
    $splitTxt = A\compose(wordSplit, arrToString)($txt);

    return $splitTxt . replaceSpaces($mTxt);
};

$curryied = A\curry($func);

$first = $curryied('more');

$final = $first('functional programming');

echo $final;