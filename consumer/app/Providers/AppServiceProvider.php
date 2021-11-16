<?php

namespace Consumer\Providers;

use Consumer\Integrations\Queue\QueueManagerInterface;
use Consumer\Integrations\Queue\RabbitmqQueueManager;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(QueueManagerInterface::class, RabbitmqQueueManager::class);
    }
}
