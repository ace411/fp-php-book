<?php

namespace Acme;

const hyphenate = __NAMESPACE__ . '\\hyphenate';

function hyphenate(array $words): string
{
  return implode('-', $words);
}
