<?php

namespace Consumer\Actions;

use Consumer\ValueObjects\Notifiable;

class SendNotificationAction
{
    public function __invoke(Notifiable $notifiable)
    {
        dd($notifiable);
    }
}
