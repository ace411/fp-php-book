<?php

set_error_handler(function ($errNo, $errStr) {
  print($errNo . ': ' . $errStr);
});

$addTen = fn ($val): int => $val + 10;

var_dump($addTen('foo'));
