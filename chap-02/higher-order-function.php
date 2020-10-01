<?php

$insertUnderscores = fn (string $text): callable => (
	fn (): string                                   => implode('_', explode(' ', $text))
);

$insertUnderscores('hello world')();
