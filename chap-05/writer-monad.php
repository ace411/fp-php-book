<?php

require __DIR__ . '/vendor/autoload.php';

use Chemem\Bingo\Functional\Functors\Monads\Writer;

$logger = fn (): Writer => (
	Writer\writer(5, 'put 5 in Writer')->bind(fn ($val) => (
		Writer\writer(null, 'add 2')->map(fn ($result) => (
			$result + ($val + 2)
		))
	))
);

$output = Writer\execWriter($logger());

print_r($output);
