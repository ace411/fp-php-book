<?php

$insertUnderscores = function (string $text) : callable {
    $words = explode(' ', $text);

    return function () use ($words) {
        return implode('_', $words);
    };
};

$insertUnderscores('hello world')();