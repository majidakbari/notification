<?php

namespace Consumer\Repositories;

interface NotificationRepositoryInterface
{
    public function updateByMessageKeyAndSetAsSent(string $messageKey): void;
}
