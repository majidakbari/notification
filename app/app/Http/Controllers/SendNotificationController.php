<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendNotificationRequest;

class SendNotificationController
{
    public function __invoke(SendNotificationRequest $request)
    {
        return response()->json();
    }
}
