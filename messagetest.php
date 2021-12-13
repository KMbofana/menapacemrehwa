<?php

require_once 'vendor/autoload.php';
$messagebird = new MessageBird\Client('efFSy6JvvrrR4sbJQfX6DiwOI');
$message = new MessageBird\Objects\Message;
$message->originator = '+263779363209';
$message->recipients = [ '+263779363209' ];
$message->body = 'Text Message with MessageBird is successful';
$response = $messagebird->messages->create($message);
print_r(json_encode($response));




?>