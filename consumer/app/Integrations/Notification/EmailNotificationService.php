<?php

namespace Consumer\Integrations\Notification;

use Throwable;

class EmailNotificationService implements NotificationServiceInterface
{
    public function send(string $to, string $name, string $message): void
    {
        try {
            mail($to, "Dear $name", $message);
        } catch (Throwable) {
        }
    }
}
