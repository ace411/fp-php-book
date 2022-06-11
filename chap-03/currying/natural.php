<?php

$func = fn (string $text): callable =>
  fn (string $moreText): string =>
    implode('-', str_split($text, 1)) . ' ' . str_replace(' ', '_', $moreText);

$first = $func('more');

$final = $first('Functional Programming');

echo $final; // m-o-r-e Functional_Programming
