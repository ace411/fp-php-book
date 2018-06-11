<?php

set_error_handler(
    function ($errNo, $errStr) {
        print($errNo . ': ' . $errStr);
    }
);

$addTen = function ($val) { return $val + 10; };

var_dump($addTen('foo'));