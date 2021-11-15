<?php

namespace App\Integrations;

use App\ValueObjects\Queueable;

interface QueueManagerInterface
{
    function publish(Queueable $queueable): void;
}
