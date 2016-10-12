<?php
require __DIR__ . '/vendor/autoload.php';

use Stomp\Client;
use Stomp\Network\Connection;
use Stomp\StatefulStomp;
use Stomp\Transport\Message;

// make a connection
$connection = new Connection('failover://(tcp://amq:61613,tcp://amq:61613)?randomize=false');
$connection->setReadTimeout(1);
$stomp = new StatefulStomp(new Client($connection));

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
