<?php

namespace App\Providers;

use App\Integrations\QueueManagerInterface;
use App\Integrations\RabbitMq\RabbitmqQueueManager;
use App\Repositories\Notification\MysqlNotificationRepository;
use App\Repositories\Notification\NotificationRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(NotificationRepositoryInterface::class, MysqlNotificationRepository::class);
        $this->app->bind(QueueManagerInterface::class, RabbitmqQueueManager::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
    }
}
