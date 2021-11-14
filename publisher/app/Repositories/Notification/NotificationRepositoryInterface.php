<?php

namespace App\Repositories\Notification;

use App\Entities\Notification;

interface NotificationRepositoryInterface
{
    function insert(Notification $notification): Notification;
}
