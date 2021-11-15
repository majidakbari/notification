<?php

namespace App\Integrations;

interface QueueManagerInterface
{
    function publish(): void;
}
