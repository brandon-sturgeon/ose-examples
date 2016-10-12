<?php

$queue  = '/queue/foo';

/* connection */
try {
    $stomp = new Stomp('tcp://localhost:61613');
} catch(StompException $e) {
    die('Connection failed: ' . $e->getMessage());
}

/* subscribe to messages from the queue 'foo' */
$stomp->subscribe($queue);

/* read a frame */
$frame = $stomp->readFrame();

if ($frame->body === $msg) {
    var_dump($frame);

    /* acknowledge that the frame was received */
    $stomp->ack($frame);
}

/* close connection */
unset($stomp);

?>