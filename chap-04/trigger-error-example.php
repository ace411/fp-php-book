<?php

$addTen = fn ($val) => (
  is_int($val) ?
    $val + 10 :
    trigger_error('Non-numeric value encountered', E_USER_WARNING)
);

var_dump($addTen('foo'));
