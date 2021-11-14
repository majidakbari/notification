<?php

namespace Tests\Helpers;

class Helpers
{
    public static function invalidAcceptHeaderDataProvider(): array
    {
        return [
            'html' => [
                'text/html'
            ],
            'xhtml' => [
                'application/xhtml+xml'
            ],
            'xml' => [
                'application/xml'
            ],
            'avif' => [
                'image/avif'
            ],
            'webp' => [
                'image/webp'
            ],
            'pdf' => [
                'application/pdf'
            ]
        ];
    }
}
