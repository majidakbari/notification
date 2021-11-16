<?php

namespace Consumer\Integrations\Notification;

class SmsNotificationService implements NotificationServiceInterface
{
    public function send(string $to, string $message): void
    {
        dd($to, $message, 'sms');
    }
}
