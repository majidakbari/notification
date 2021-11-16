<?php

namespace ConsumerTests\Unit\Repositories;

use Carbon\Carbon;
use Consumer\Repositories\MysqlNotificationRepository;
use ConsumerTests\TestCase;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Testing\DatabaseTransactions;
use PDO;

class MysqlNotificationRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @group unit
     */
    public function testUpdateByMessageKeyAndSetAsSentShouldWork(): void
    {
        //arrange
        $to = 'foo';
        $name = 'bar';
        $message = 'hello world';
        $type = 1;
        $sent = 0;
        $key = 'buzz';
        $dateTime = Carbon::now();
        $this->insertDummyNotificationIntoDatabase(
            $to,
            $name,
            $message,
            $type,
            $sent,
            $key,
            $dateTime
        );
        $repository = new MysqlNotificationRepository();

        //act
        $repository->updateByMessageKeyAndSetAsSent($key);

        //assert
        $dbRecord = $this->findByKey($key);
        $this->assertSame(1, $dbRecord['sent']);
    }

    public function findByKey(string $key): array
    {
        $pdo = $this->getPdo();
        $result = $pdo->query("SELECT * FROM notifications WHERE `message_key` = '$key'");

        return $result->fetch(PDO::FETCH_ASSOC);
    }

    private function insertDummyNotificationIntoDatabase(
        string $to,
        string $name,
        string $message,
        string $type,
        int $sent,
        string $key,
        Carbon $dateTime
    ): void {
        $pdo = $this->getPdo();
        $sql = 'INSERT INTO notifications' .
            '(`to`, `name`, `message`, `type`, `sent`, `message_key`, `created_at`, `updated_at`)' .
            'VALUES (?,?,?,?,?,?,?,?)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $to,
            $name,
            $message,
            $type,
            $sent,
            $key,
            $dateTime,
            $dateTime
        ]);
    }

    private function getPdo(): PDO
    {
        return DB::connection()->getPdo();
    }
}
