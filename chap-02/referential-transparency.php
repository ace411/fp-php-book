<?php

$insertUnderscores = function (string $text) : string {
    $withUnderscore = implode('_', explode(' ', $text));

    return $withUnderscore;
};

var_dump($insertUnderscores('hello world') == 'hello_world');