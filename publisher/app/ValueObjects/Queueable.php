<?php

namespace App\ValueObjects;

class Queueable
{
    public const NOTIFICATION_QUEUE = 'notifications';

    public function __construct(private string $queueName, private array $message)
    {
    }

    public function serialize(): string
    {
        return json_encode($this->message);
    }

    public function getQueueName(): string
    {
        return $this->queueName;
    }
}
