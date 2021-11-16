<?php

namespace Consumer\Providers;

use Consumer\Integrations\Queue\QueueManagerInterface;
use Consumer\Integrations\Queue\RabbitmqQueueManager;
use Consumer\Repositories\MysqlNotificationRepository;
use Consumer\Repositories\NotificationRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(QueueManagerInterface::class, RabbitmqQueueManager::class);
        $this->app->bind(NotificationRepositoryInterface::class, MysqlNotificationRepository::class);
    }
}
