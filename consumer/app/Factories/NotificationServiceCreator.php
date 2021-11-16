<?php

namespace Consumer\Factories;

use Consumer\Integrations\Notification\NotificationServiceInterface;
use Consumer\ValueObjects\Notifiable;

abstract class NotificationServiceCreator
{
    abstract protected function factoryMethod(): NotificationServiceInterface;

    public function handle(Notifiable $notifiable): void
    {
        $this->factoryMethod()->send($notifiable->getTo(), $notifiable->getMessage());
    }
}
