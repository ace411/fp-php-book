<?php

if (!extension_loaded('parallel')) {
  exit();
}

$channel  = Channel::make('sum'); // create channel
$runtime  = new Runtime(__DIR__ . '/vendor/autoload.php');

$future   = $runtime->run(function (Channel $ch) {
  $data = $ch->recv();
  $sum  = fn (int $x, int $y): int => $x + $y;

  return f\map(fn ($values) => $sum(...$values), $data);
}, [$channel]);

$channel->send([
  [1, 5],
  [6, 10],
]);

print_r($future->value());
