<?php

namespace ValueObjects\Tests\Number;

use ValueObjects\Tests\TestCase;
use ValueObjects\Number\Float;

class FloatTest extends TestCase
{
    public function testGetValue()
    {
        $float = new Float(3.4);
        $this->assertEquals(3.4, $float->getValue());
    }

    public function testEquals()
    {
        $float1 = new Float(5.64);
        $float2 = new Float(5.64);
        $float3 = new Float(6.01);

        $this->assertTrue($float1->equals($float2));
        $this->assertTrue($float2->equals($float1));
        $this->assertFalse($float1->equals($float3));

        $mock = $this->getMock('ValueObjects\ValueObjectInterface');
        $this->assertFalse($float1->equals($mock));
    }

    public function testToString()
    {
        $float = new Float(.7);
        $this->assertEquals('.7', $float->__toString());
    }
}
