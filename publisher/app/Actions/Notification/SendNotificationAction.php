<?php

namespace App\Actions\Notification;

use App\DataTransferObjects\Notification\SendNotificationDto;
use App\Entities\Notification;
use App\Integrations\QueueManagerInterface;
use App\Repositories\Notification\NotificationRepositoryInterface;

class SendNotificationAction
{
    public function __construct(
        private QueueManagerInterface $queueManager,
        private NotificationRepositoryInterface $notificationRepository
    ) {
    }

    public function __invoke(SendNotificationDto $dto): void
    {
        $this->queueManager->publish();
        $this->insertNotification($dto);
    }

    private function insertNotification(SendNotificationDto $dto): void
    {
        $notification = new Notification();
        $notification->to = $dto->to;
        $notification->name = $dto->name;
        $notification->message = $dto->message;
        $notification->type = Notification::getTypeDatabaseValue($dto->type);
        $notification->sent = false;
        $notification->created_at = now();
        $notification->updated_at = now();

        $this->notificationRepository->insert($notification);
    }
}
