<?php

const hyphenate = 'hyphenate';

function hyphenate(string $word) : string
{
    $hyphenated = implode('-', str_split($word));

    return $hyphenated;
}
