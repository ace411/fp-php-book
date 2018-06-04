<?php

$func = function (string $text) : callable {
    $splitTxt = implode('-', str_split($text, 1));

    return function (string $moreText) use ($splitTxt) {
        return $splitTxt . str_replace(' ', '_', $moreText);
    };
};

$first = $func('more');

$final = $first('functional programming');

echo $final;