<?php

const PHRASE = 'Functional Programming rocks';

$convert = strtoupper(preg_replace('/\s+/', '_', PHRASE));

echo $convert;
