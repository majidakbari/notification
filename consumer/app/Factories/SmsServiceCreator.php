<?php

namespace Consumer\Factories;

use Consumer\Integrations\Notification\NotificationServiceInterface;
use Consumer\Integrations\Notification\SmsNotificationService;
use Illuminate\Contracts\Container\BindingResolutionException;

class SmsServiceCreator extends NotificationServiceCreator
{
    /**
     * @throws BindingResolutionException
     */
    protected function factoryMethod(): NotificationServiceInterface
    {
        return app()->make(SmsNotificationService::class);
    }
}
