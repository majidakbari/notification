<?php

namespace App\Http\Controllers\Notification;

use App\Http\Requests\Notification\SendNotificationRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SendNotificationController
{
    public function __invoke(SendNotificationRequest $request): JsonResponse
    {
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
