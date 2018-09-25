<?php

require 'fibonacci.php';
require __DIR__ . '/vendor/autoload.php';

use Chemem\Bingo\Functional\Functors\Monads\IO;
use function Chemem\Bingo\Functional\Algorithms\{compose, partialRight};
use PhpAmqpLib\{
    Message\AMQPMessage,
    Connection\AMQPStreamConnection
};

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');

$channel = $connection->channel();

$channel->queue_declare('hello', false, false, false, false);

printf('%s', 'Waiting for input' . PHP_EOL);

$callback = function ($msg) : IO {
    $result = compose(
        partialRight('json_decode', true),
        function (array $inputs) {
            $result = fibGenerate(...$inputs);

            return $result;
        },
        'json_encode'
    );

    return IO::of($msg)
        ->map(function ($msg) use ($result) {
            return printf('%s', 'Processed ' . $result($msg->body) . \PHP_EOL);
        });
};

$channel->basic_consume('hello', '', false, true, false, false, $callback);

while(count($channel->callbacks)) {
    $channel->wait();
}

$channel->close();
$connection->close();