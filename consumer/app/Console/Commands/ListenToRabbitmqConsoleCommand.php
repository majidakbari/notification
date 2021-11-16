<?php

namespace Consumer\Console\Commands;

use Consumer\Actions\SendNotificationAction;
use Consumer\Integrations\QueueManagerInterface;
use Consumer\ValueObjects\Notifiable;
use Illuminate\Console\Command;

class ListenToRabbitmqConsoleCommand extends Command
{
    protected $signature = 'rabbitmq:listen';

    protected $description = 'This command consumes the rabbitmq';

    public function __construct(
        private QueueManagerInterface $queueManager,
        private SendNotificationAction $sendNotificationAction
    )
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $this->info('consuming');
        $this->queueManager->consume('notifications', '', function (string $messageBody) {
            $message = json_decode($messageBody);
            $notifiable = new Notifiable(
                $message->type,
                $message->to,
                $message->name,
                $message->message,
                $message->key
            );
            ($this->sendNotificationAction)($notifiable);
        });
    }
}
