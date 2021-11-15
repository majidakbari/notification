<?php

namespace Consumer\Integrations;

use Exception;
use Illuminate\Config\Repository;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class RabbitmqQueueManager
{
    private AMQPChannel $channel;
    private AMQPStreamConnection $connection;

    /**
     * @throws Exception
     */
    public function __construct(Repository $configRepository)
    {
        $this->connection = AMQPStreamConnection::create_connection($this->getRabbitmqConnection());
        $this->channel = $this->connection->channel();
    }

    private function getRabbitmqConnection(): array
    {
        return [
            [
                'host' => env('RABBITMQ_HOST'),
                'port' => env('RABBITMQ_PORT'),
                'user' => env('RABBITMQ_USERNAME'),
                'password' => env('RABBITMQ_PASSWORD'),
            ]
        ];
    }
}
