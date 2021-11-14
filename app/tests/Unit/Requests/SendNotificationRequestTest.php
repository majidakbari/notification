<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\SendNotificationRequest;
use App\Rules\IranianPhoneNumberValidationRule;
use Illuminate\Validation\Rule;
use Tests\TestCase;

class SendNotificationRequestTest extends TestCase
{
    /**
     * @group unit
     * @dataProvider dataProvider
     */
    public function testRules_shouldWork(SendNotificationRequest $request, array $expected): void
    {
        //act
        $actual = $request->rules();

        //assert
        $this->assertEquals($expected, $actual);
    }

    public function dataProvider(): array
    {
        return [
            'type is not valid' => [
                new SendNotificationRequest(['type' => 'foo']),
                [
                    'to' => ['required', 'string', 'max:60', null],
                    'name' => ['required', 'string', 'max:60'],
                    'message' => ['required', 'string', 'max:10000'],
                    'type' => ['required', Rule::in(['sms', 'email'])]
                ]
            ],
            'type is equal to sms' => [
                new SendNotificationRequest(['type' => 'email']),
                [
                    'to' => ['required', 'string', 'max:60', 'email'],
                    'name' => ['required', 'string', 'max:60'],
                    'message' => ['required', 'string', 'max:10000'],
                    'type' => ['required', Rule::in(['sms', 'email'])]
                ]
            ],
            'type is equal to email' => [
                new SendNotificationRequest(['type' => 'sms']),
                [
                    'to' => ['required', 'string', 'max:60', new IranianPhoneNumberValidationRule()],
                    'name' => ['required', 'string', 'max:60'],
                    'message' => ['required', 'string', 'max:10000'],
                    'type' => ['required', Rule::in(['sms', 'email'])]
                ]
            ],
        ];


    }
}
