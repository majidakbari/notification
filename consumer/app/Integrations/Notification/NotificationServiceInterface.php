<?php

namespace Consumer\Integrations\Notification;

interface NotificationServiceInterface
{
    public function send(string $to, string $name, string $message): void;
}
