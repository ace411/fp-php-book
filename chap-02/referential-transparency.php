<?php

$insertUnderscores = fn (string $text): string => implode('_', explode(' ', $text));

var_dump($insertUnderscores('hello world') == 'hello_world');
