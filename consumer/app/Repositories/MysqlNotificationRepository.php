<?php

namespace Consumer\Repositories;

use Illuminate\Support\Facades\DB;
use PDO;

class MysqlNotificationRepository implements NotificationRepositoryInterface
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = DB::connection()->getPdo();
    }

    public function updateByMessageKeyAndSetAsSent(string $messageKey): void
    {
        $sql = 'UPDATE notifications SET `sent` = ? WHERE `message_key` = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([1, $messageKey]);
    }
}
