<?php

namespace Tests\Unit\DataTransferObjects\Notification;

use App\DataTransferObjects\Notification\SendNotificationDto;
use Tests\TestCase;

class SendNotificationDtoTest extends TestCase
{
    public function testFromArray_shouldWork(): void
    {
        //arrange
        $to = 'foo';
        $name = 'john doe';
        $message = 'bar';
        $type = 'buzz';
        $data = (compact('to', 'name', 'message', 'type'));

        //act
        $dto = SendNotificationDto::fromArray($data);

        //assert
        $this->assertEquals($to, $dto->to);
        $this->assertEquals($name, $dto->name);
        $this->assertEquals($message, $dto->message);
        $this->assertEquals($type, $dto->type);
    }
}
