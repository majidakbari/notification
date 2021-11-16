<?php

namespace Consumer\Integrations\Notification;

use GuzzleHttp\Client;
use Throwable;

class SmsNotificationService implements NotificationServiceInterface
{
    public function send(string $to, string $name, string $message): void
    {
        $client = new Client();
        try {
            $client->request('POST', 'https://www.sendsms.com', [
                'form_params' => [
                    'to' => $to,
                    'message' => $message,
                    'name' => $name
                ],
                'connect_timeout' => 1
            ]);
        } catch (Throwable) {
        }
    }
}
