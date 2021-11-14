<?php

namespace App\Http\Controllers\Notification;

use App\Http\Requests\Notification\SendNotificationRequest;

class SendNotificationController
{
    public function __invoke(SendNotificationRequest $request)
    {
        return response()->json();
    }
}
