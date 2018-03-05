<?php

namespace App\Infrastructure;

class ReplicateQueueClient
{

    protected $queueUrl;
    protected $sqsClient;

    public function __construct($queueUrl, $sqsClient)
    {
        $this->queueUrl = $queueUrl;
        $this->sqsClient = $sqsClient;
    }

    public function sendMessage($messageBody)
    {
        $this->sqsClient->sendMessage([
            'QueueUrl'    => $this->queueUrl,
            'MessageBody' => json_encode($messageBody)
        ]);
    }

}
