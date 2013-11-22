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

        $this->assertTrue($float1->equals($float2));
        $this->assertTrue($float2->equals($float1));
    }

    public function testToString()
    {
        $float = new Float(.7);
        $this->assertEquals('.7', $float->__toString());
    }
}