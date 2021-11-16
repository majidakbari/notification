<?php

namespace Consumer\Integrations\Notification;

class EmailNotificationService implements NotificationServiceInterface
{
    public function send(string $to, string $message): void
    {
        dd($to, $message, 'email');
    }
}
