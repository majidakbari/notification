<?php

namespace Tests\Unit\Middleware;

use Tests\Helpers\Helpers;
use Tests\TestCase;
use Illuminate\Http\Request;
use App\Http\Middleware\OnlyJsonResponseMiddleware;
use App\Exceptions\HttpException\InvalidAcceptHeaderException;

class OnlyJsonResponseMiddlewareTest extends TestCase
{
    /**
     * @group unit
     * @group middleware
     * @dataProvider invalidAcceptHeaderDataProvider
     */
    public function testHandle_shouldThrowException(string $acceptHeader): void
    {
        $this->expectException(InvalidAcceptHeaderException::class);

        $request = new Request([], [], [], [], [], [
            'REQUEST_URI' => 'test/unit/',
            'HTTP_ACCEPT' => $acceptHeader
        ]);

        (new OnlyJsonResponseMiddleware())->handle($request);
    }

    /**
     * @group unit
     * @group middleware
     * @dataProvider validAcceptHeaderDataProvider
     */
    public function testHandle_shouldCallTheNextMiddleware(?string $acceptHeader): void
    {
        $request = new Request([], [], [], [], [], [
            'REQUEST_URI' => 'test/unit/',
            'HTTP_ACCEPT' => $acceptHeader
        ]);

        (new OnlyJsonResponseMiddleware())->handle($request, function () {
            $this->assertTrue(true);
        });
    }

    public function invalidAcceptHeaderDataProvider(): array
    {
        return Helpers::invalidAcceptHeaderDataProvider();
    }

    public function validAcceptHeaderDataProvider(): array
    {
        return [
            'all accept headers' => [
                '*/*'
            ],
            'json' => [
                'application/json'
            ],
            'accept header is not provider' => [
                null
            ]
        ];
    }
}
