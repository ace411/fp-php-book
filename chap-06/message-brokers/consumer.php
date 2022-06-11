<?php

require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../task.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use Chemem\Bingo\{
  Functional as f,
  Functional\Functors\Monads\IO,
  Functional\Functors\Monads as m
};

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');

$channel = $connection->channel();

$channel->queue_declare('hello', false, false, false, false);

printf('%s', 'Waiting for input' . PHP_EOL);

$callback = function ($msg) : IO {
  $result = f\compose(
    f\partialRight('json_decode', true),
    fn (array $inputs): string => fibGenerate(...$inputs)
  );

  return m\bind(
    fn ($msg) => IO\_print(IO\IO(f\concat(' ', 'Processed', $result($msg->body)))),
    IO::of($msg)
  );
};

$channel->basic_consume('hello', '', false, true, false, false, $callback);

while (count($channel->callbacks)) {
  $channel->wait();
}

$channel->close();
$connection->close();
