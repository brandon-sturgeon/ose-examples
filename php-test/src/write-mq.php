<?php
require __DIR__ . '/vendor/autoload.php';

use Stomp\Client;
use Stomp\StatefulStomp;
use Stomp\Transport\Message;

// make a connection
$stomp = new StatefulStomp(
    new Client('failover://(tcp://amq:61613,tcp://amq:61613)?randomize=false')
);

$message = uniqid();

// send a message to the queue
$stomp->send('/queue/test', new Message($message));
echo "Sent message with body $message\n";