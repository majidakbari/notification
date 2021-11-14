<?php

namespace App\Providers;

use App\Repositories\Notification\MysqlNotificationRepository;
use App\Repositories\Notification\NotificationRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(NotificationRepositoryInterface::class, MysqlNotificationRepository::class);
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
