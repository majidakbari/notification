<?php

namespace Consumer\ValueObjects;

class Notifiable
{
    public function __construct(
        private string $type,
        private string $to,
        private string $name,
        private string $message,
        private string $messageKey,
    )
    {
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }

    public function getName(): string
    {
        return $this->name;
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
