<?php

require 'fibonacci.php';
require __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use function Chemem\Bingo\Functional\Algorithms\{compose, partialRight};
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');

$channel = $connection->channel();

$channel->queue_declare('hello', false, false, false, false);

printf('%s', 'Waiting for input' . PHP_EOL);

$callback = function ($msg) {
    $result = compose(
        partialRight('json_decode', true),
        function (array $inputs) {
            $result = fibGenerate(...$inputs);

            return $result;
        },
        partialRight('json_encode', JSON_PRETTY_PRINT)
    );

    printf('%s', 'Processed ' . $result($msg));
};

$channel->basic_consume('hello', '', false, true, false, false, $callback);

while(count($channel->callbacks)) {
    $channel->wait();
}

$channel->close();
$connection->close();