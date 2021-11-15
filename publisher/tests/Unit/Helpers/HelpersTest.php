<?php

namespace Tests\Unit\Helpers;

use App\Helpers\Helpers;
use Symfony\Component\VarDumper\Cloner\Stub;
use Tests\TestCase;

class HelpersTest extends TestCase
{
    /**
     * @group unit
     */
    public function testGetClassNameShouldWork(): void
    {
        //arrange
        $instance = new Stub();

        //act
        $actual = Helpers::getClassName($instance);

        //assert
        $this->assertSame('Stub', $actual);
    }
}
