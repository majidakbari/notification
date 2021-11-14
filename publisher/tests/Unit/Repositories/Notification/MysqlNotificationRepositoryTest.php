<?php

namespace Tests\Unit\Repositories\Notification;

use App\Entities\Notification;
use App\Repositories\Notification\MysqlNotificationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MysqlNotificationRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    public function testInsert_shouldWork(): void
    {
        //arrange
        $notification = Notification::factory()->make();
        $repository = new MysqlNotificationRepository();

        //act
        $result = $repository->insert($notification);

        //assert
        $this->assertDatabaseHas('notifications', $notification->toArray());
        $this->assertNotNull($result->id);
    }
}
