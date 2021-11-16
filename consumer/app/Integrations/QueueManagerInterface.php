<?php

namespace Consumer\Integrations;

interface QueueManagerInterface
{
    public function consume(
        string $queueName,
        string $consumerTag,
        callable $callback,
        string $exchange = '',
        string $type = 'default'
    ): void;
}
