<?php

namespace App\Repositories\Notification;

use App\Entities\Notification;

interface NotificationRepositoryInterface
{
    public function insert(Notification $notification): Notification;
}
