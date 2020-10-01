<?php

require __DIR__ . '/vendor/autoload.php';

use Qaribou\Collection\ImmArray;

$words = ImmArray::fromArray(['FP', 'is', 'cool']);

echo $words
  ->map(fn (string $word): string => implode('-', str_split($word, 1)))
  ->join(' ');
