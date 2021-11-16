<?php

namespace Consumer\Actions;

use Consumer\Factories\NotificationServiceCreator;
use Consumer\ValueObjects\Notifiable;

class SendNotificationAction
{
    private ?NotificationServiceCreator $notificationServiceCreator;

    public function setNotificationServiceCreator(
        ?NotificationServiceCreator $notificationServiceCreator
    ): SendNotificationAction {
        $this->notificationServiceCreator = $notificationServiceCreator;

        return $this;
    }

    public function __invoke(Notifiable $notifiable): void
    {
        $this->notificationServiceCreator?->handle($notifiable);
    }
}
