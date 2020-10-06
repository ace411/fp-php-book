<?php

namespace Acme;

function hyphenate(array $words): string
{
  return implode('-', $words);
}

const hyphenate = __NAMESPACE__ . '\\hyphenate';
