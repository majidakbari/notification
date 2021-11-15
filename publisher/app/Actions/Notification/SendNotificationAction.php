<?php

namespace App\Actions\Notification;

use App\DataTransferObjects\Notification\SendNotificationDto;
use App\Entities\Notification;
use App\Integrations\QueueManagerInterface;
use App\Repositories\Notification\NotificationRepositoryInterface;
use App\ValueObjects\Queueable;

class SendNotificationAction
{
    public function __construct(
        private QueueManagerInterface $queueManager,
        private NotificationRepositoryInterface $notificationRepository
    ) {
    }

    public function __invoke(SendNotificationDto $dto): void
    {
        $messageKey = uniqid(more_entropy: true);
        $this->publishMessageToQueue($dto, $messageKey);
        $this->insertNotification($dto, $messageKey);
    }

    private function insertNotification(SendNotificationDto $dto, string $messageKey): void
    {
        $notification = new Notification();
        $notification->to = $dto->to;
        $notification->name = $dto->name;
        $notification->message = $dto->message;
        $notification->type = Notification::getTypeDatabaseValue($dto->type);
        $notification->sent = false;
        $notification->message_key = $messageKey;
        $notification->created_at = now();
        $notification->updated_at = now();

        $this->notificationRepository->insert($notification);
    }

    private function publishMessageToQueue(SendNotificationDto $dto, string $messageKey): void
    {
        $this->queueManager->publish(new Queueable(
            Queueable::NOTIFICATION_QUEUE,
            [
                    'to' => $dto->to,
                    'name' => $dto->name,
                    'message' => $dto->message,
                    'type' => $dto->type,
                    'key' => $messageKey
                ]
        ));
    }
}
