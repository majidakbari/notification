<?php

namespace Consumer\Factories;

use Consumer\Integrations\Notification\EmailNotificationService;
use Consumer\Integrations\Notification\NotificationServiceInterface;
use Illuminate\Contracts\Container\BindingResolutionException;

class EmailServiceCreator extends NotificationServiceCreator
{
    /**
     * @throws BindingResolutionException
     */
    protected function factoryMethod(): NotificationServiceInterface
    {
        return app()->make(EmailNotificationService::class);
    }
}
