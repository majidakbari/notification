<?php

namespace App\Integrations\RabbitMq;

use App\Integrations\QueueManagerInterface;
use App\ValueObjects\Queueable;
use Exception;
use Illuminate\Config\Repository;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitmqQueueManager implements QueueManagerInterface
{
    private const MESSAGE_PROPERTIES = [
        'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT
    ];
    private AMQPChannel $channel;
    private AMQPStreamConnection $connection;

    /**
     * @throws Exception
     */
    public function __construct(Repository $configRepository)
    {
        $this->connection = AMQPStreamConnection::create_connection($configRepository->get('rabbitmq'));
        $this->channel = $this->connection->channel();
    }

    /**
     * @throws Exception
     */
    public function publish(Queueable $queueable): void
    {
        $this->channel->queue_declare($queueable->getQueueName(), false, true, false, false);
        $msg = new AMQPMessage($queueable->serialize(), self::MESSAGE_PROPERTIES);
        $this->channel->basic_publish($msg, routing_key: $queueable->getQueueName());
        $this->channel->close();
        $this->connection->close();
    }
}
