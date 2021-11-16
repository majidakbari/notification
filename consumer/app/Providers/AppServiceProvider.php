<?php

namespace Consumer\Providers;

use Consumer\Integrations\QueueManagerInterface;
use Consumer\Integrations\RabbitmqQueueManager;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(QueueManagerInterface::class, RabbitmqQueueManager::class);
    }
}
