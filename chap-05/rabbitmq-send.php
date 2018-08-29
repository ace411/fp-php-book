<?php

require __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');

$channel = $connection->channel();

$channel->queue_declare('hello', false, false, false, false);

$msg = new AMQPMessage(json_encode([1, 10]));

$channel->basic_publish($msg, '', 'hello');

printf('%s', 'Sent data to hello queue' . PHP_EOL);

$channel->close();
$connection->close();