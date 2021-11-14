<?php

namespace App\Http\Controllers\Notification;

use App\Actions\SendNotificationAction;
use App\DataTransferObjects\Notification\SendNotificationDto;
use App\Http\Requests\Notification\SendNotificationRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SendNotificationController
{
    public function __construct(private SendNotificationAction $sendNotificationAction)
    {
    }

    public function __invoke(SendNotificationRequest $request): JsonResponse
    {
        ($this->sendNotificationAction)(SendNotificationDto::fromArray($request->validated()));

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
