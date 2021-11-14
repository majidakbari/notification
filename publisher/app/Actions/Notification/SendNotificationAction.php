<?php

namespace App\Actions\Notification;

use App\DataTransferObjects\Notification\SendNotificationDto;
use App\Entities\Notification;
use App\Repositories\Notification\NotificationRepositoryInterface;

class SendNotificationAction
{
    public function __construct(private NotificationRepositoryInterface $notificationRepository)
    {
    }

    public function __invoke(SendNotificationDto $dto): void
    {

    }

    private function insertNotification(SendNotificationDto $dto): Notification
    {
        $notification = new Notification();
        $notification->to = $dto->to;
        $notification->name = $dto->name;
        $notification->message = $dto->message;
        $notification->type = Notification::getTypeDatabaseValue($dto->type);
        $notification->sent = false;
        $notification->created_at = now();
        $notification->updated_at = now();

        return $this->notificationRepository->insert($notification);
    }
}
