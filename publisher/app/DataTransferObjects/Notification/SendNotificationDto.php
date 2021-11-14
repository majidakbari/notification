<?php

namespace App\DataTransferObjects\Notification;

class SendNotificationDto
{
    public function __construct(public string $to, public string $name, public string $message, public string $type)
    {
    }

    public static function fromArray(array $data): static
    {
        return new static($data['to'], $data['name'], $data['message'], $data['type']);
    }
}
