<?php

namespace Tests\Unit\Entities;

use App\Entities\Notification;
use Tests\TestCase;

class NotificationTest extends TestCase
{
    /**
     * @group unit
     * @dataProvider typeDataProvider
     */
    public function testGetTypeAttribute_shouldWork(int $type, string $typeLabel): void
    {
        //arrange
        $notification = new Notification();

        //act
        $actual = $notification->getTypeAttribute($type);

        //assert
        $this->assertEquals($typeLabel, $actual);
    }

    public function typeDataProvider(): array
    {
        return [
            'sms' => [
                1,
                'sms'
            ],
            'email' => [
                2,
                'email'
            ]
        ];
    }
}
