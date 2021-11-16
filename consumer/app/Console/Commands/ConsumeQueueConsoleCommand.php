<?php

namespace Consumer\Console\Commands;

use Consumer\Actions\SendNotificationAction;
use Consumer\Factories\EmailServiceCreator;
use Consumer\Factories\SmsServiceCreator;
use Consumer\Integrations\Queue\QueueManagerInterface;
use Consumer\ValueObjects\Notifiable;
use Illuminate\Console\Command;
use Illuminate\Contracts\Container\BindingResolutionException;
use InvalidArgumentException;
use stdClass;

class ConsumeQueueConsoleCommand extends Command
{
    private const MESSAGE_TYPE_SMS = 'sms';
    private const MESSAGE_TYPE_EMAIL = 'email';

    protected $signature = 'queue:consume';

    protected $description = 'This command consumes the rabbitmq';

    public function __construct(private QueueManagerInterface $queueManager)
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $this->info('consuming...');

        $this->queueManager->consume('notifications', '', function (string $messageBody) {
            $this->sendNotification(json_decode($messageBody));
        });
    }

    /**
     * @param stdClass $message
     * @throws BindingResolutionException
     */
    private function sendNotification(stdClass $message): void
    {
        $type = $message->type;
        $action = app()->make(SendNotificationAction::class);
        $notificationServiceCreator = match($type) {
            self::MESSAGE_TYPE_EMAIL => new EmailServiceCreator(),
            self::MESSAGE_TYPE_SMS => new SmsServiceCreator(),
            default => throw new InvalidArgumentException()
        };
        $notifiable = new Notifiable(
            $message->to,
            $message->name,
            $message->message,
            $message->key
        );
        ($action->setNotificationServiceCreator($notificationServiceCreator))($notifiable);
    }
}
