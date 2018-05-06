<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/hyphenate.php';

use Qaribou\Collection\ImmArray;

$words = ImmArray::fromArray(['FP', 'is', 'cool']);

echo $words
    ->map(hyphenate)
    ->join(' ');