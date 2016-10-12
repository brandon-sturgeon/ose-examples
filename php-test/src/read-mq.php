<?php
require __DIR__ . '/vendor/autoload.php';

use Stomp\Client;
use Stomp\StatefulStomp;
use Stomp\Transport\Message;

// make a connection
$stomp = new StatefulStomp(
    new Client('failover://(tcp://amq:61613,tcp://amq:61613)?randomize=false')
);

// subscribe to the queue
$stomp->subscribe('/queue/test', null, 'client-individual');

// receive a message from the queue
$msg = $stomp->read();

// do what you want with the message
if ($msg != null) {
    echo "Received message with body '$msg->body'\n";
    // mark the message as received in the queue
    $stomp->ack($msg);
} else {
    echo "Failed to receive a message\n";
}
