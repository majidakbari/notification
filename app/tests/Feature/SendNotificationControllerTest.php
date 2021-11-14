<?php

namespace Tests\Feature;

use Tests\Helpers\Helpers;
use Tests\TestCase;

class SendNotificationControllerTest extends TestCase
{
    private const NOTIFICATION_URI = '/api/notification';

    /**
     * @group feature
     */
    public function testInvoke_shouldWorkForSendingSms(): void
    {
        //arrange
        $data = [
            'to' => '989121112233',
            'name' => 'John Doe',
            'message' => 'foo',
            'type' => 'sms',
        ];

        //act
        $response = $this->postJson(self::NOTIFICATION_URI, $data);

        //assert
        $response->assertStatus(204);
    }

    /**
     * @group feature
     */
    public function testInvoke_shouldWorkForSendingEmail(): void
    {
        //arrange
        $data = [
            'to' => 'foo@bar.com',
            'name' => 'John Doe',
            'message' => '<h1>foo<h1>',
            'type' => 'email',
        ];

        //act
        $response = $this->postJson(self::NOTIFICATION_URI, $data);

        //assert
        $response->assertStatus(204);
    }

    /**
     * @group feature
     * @dataProvider invalidAcceptHeaderDataProvider
     */
    public function testInvoke_shouldFailWhenAcceptHeaderIsNotValid(string $acceptHeader): void
    {
        //act
        $response = $this->postJson(self::NOTIFICATION_URI, [], ['accept' => $acceptHeader]);

        //assert
        $response->assertStatus(406);
        $response->assertJson([
            'error' => 'InvalidAcceptHeaderException',
            'message' => 'This application only supports json response.'
        ]);
    }

    /**
     * @group feature
     * @dataProvider invalidInputDataProvider
     */
    public function testInvoke_shouldReturn422ForInvalidInput(
        ?string $to,
        ?string $name,
        ?string $message,
        ?string $type,
        array $expectedKeys
    ): void {
        //arrange
        $data = compact($to, $name, $message, $type);

        //act
        $response = $this->postJson(self::NOTIFICATION_URI, $data);

        $response->assertStatus(422);
        $response->assertJsonStructure($expectedKeys);
    }

    public function invalidAcceptHeaderDataProvider(): array
    {
        return Helpers::invalidAcceptHeaderDataProvider();
    }

    public function invalidInputDataProvider(): array
    {
        return [
            'all inputs are null' => [
                null,
                null,
                null,
                null,
                ['to', 'name', 'message', 'type']
            ],
            'type field is not valid' => [
                'foo@bar.com',
                'John Doe',
                'Lorem ipsum',
                'buzz',
                ['type']
            ],
            'to field is not a valid phone number' => [
                'foo',
                'John Doe',
                'Lorem ipsum',
                'sms',
                ['to']
            ],
            'to field is not a valid email address' => [
                'bar@',
                'John Doe',
                'Lorem ipsum',
                'email',
                ['to']
            ],
            'name field is too long, more than 60 characters which is the api limit' => [
                'foo@bar.com',
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore',
                'Lorem ipsum',
                'email',
                ['name']
            ]
        ];
    }
}
