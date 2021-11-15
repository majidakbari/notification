<?php

namespace App\Integrations;

use App\ValueObjects\Queueable;

interface QueueManagerInterface
{
    public function publish(Queueable $queueable): void;
}
