<?php

const PHRASE = 'functional programming rocks';

$result = strtoupper(preg_replace('/\s+/', '_', PHRASE));

echo $result;
