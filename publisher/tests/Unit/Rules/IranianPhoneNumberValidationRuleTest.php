<?php

namespace Tests\Unit\Rules;

use App\Rules\IranianPhoneNumberValidationRule;
use Symfony\Component\VarDumper\Cloner\Stub;
use Tests\TestCase;

class IranianPhoneNumberValidationRuleTest extends TestCase
{
    /**
     * @group unit
     * @dataProvider mobileNumberDataProvider
     */
    public function testPasses_shouldWork(string|array|int|object $mobileNumber, bool $expected): void
    {
        //arrange
        $rule = new IranianPhoneNumberValidationRule();

        //act
        $actual = $rule->passes('foo', $mobileNumber);

        $this->assertEquals($expected, $actual);
    }

    public function mobileNumberDataProvider(): array
    {
        return [
            'starting with 0098' => [
                '00989121112233',
                true
            ],
            'starting with +98' => [
                '+989121112233',
                true
            ],
            'starting with 98' => [
                '989121112233',
                true
            ],
            'starting with 09' => [
                '09121112233',
                true
            ],
            'Irancell' => [
                '09351112233',
                true
            ],
            'hamrahe aval' => [
                '09191112233',
                true
            ],
            'non iranian number' => [
                '00469191112233',
                false
            ],
            'not starting with 9' => [
                '00988191112233',
                false
            ],
            'longer than iranian numbers' => [
                '009891911122334',
                false
            ],
            'shorter than iranian numbers' => [
                '0098919111223',
                false
            ],
            'array input' => [
                [1, 2],
                false
            ],
            'integer input' => [
                9121112233,
                false
            ],
            'object input' => [
                new Stub(),
                false
            ]
        ];
    }
}
