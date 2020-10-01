<?php

require __DIR__ . '/vendor/autoload.php';

use function Chemem\Bingo\Functional\Algorithms\{compose, curry};

function wordSplit(string $text) : array
{
  return str_split($text, 1);
}

function replaceSpaces(string $text) : string
{
  return str_replace(' ', '_', $text);
}

function arrToString(array $strings) : string
{
  return implode('_', $strings);
}

$func = function (string $text, string $moreText) : string {
  $composite = compose(
    'wordsplit',
    'arrToString',
    fn (string $txt): string => $txt . replaceSpaces($moreText),
  );

  return $composite($text);
};

$curryied = curry($func);

$first    = $curryied('more');

$final    = $first('functional programming');

echo $final;
