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
    public function testGetTypeDatabaseValueShouldWork(string $typeLabel, int $typeValue): void
    {
        //arrange
        $notification = new Notification();

        //act
        $actual = $notification->getTypeDatabaseValue($typeLabel);

        //assert
        $this->assertEquals($typeValue, $actual);
    }

    public function typeDataProvider(): array
    {
        return [
            'sms' => [
                'sms',
                1
            ],
            'email' => [
                'email',
                2
            ]
        ];
    }
}
