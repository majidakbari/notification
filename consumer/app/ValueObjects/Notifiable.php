<?php

namespace Consumer\ValueObjects;

class Notifiable
{
    public function __construct(private string $to, private string $message, private string $messageKey)
    {
    }

    public function getTo(): string
    {
        return $this->to;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getMessageKey(): string
    {
        return $this->messageKey;
    }
}
