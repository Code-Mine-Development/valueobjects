<?php

namespace ValueObjects\Tests\Number;

use ValueObjects\Tests\TestCase;
use ValueObjects\Number\Integer;

class IntegerTest extends TestCase
{
    public function testGetValue()
    {
        $integer = new Integer(5);
        $this->assertSame(5, $integer->getValue());
    }

    public function testEquals()
    {
        $integer1 = new Integer(3);
        $integer2 = new Integer(3);
        $integer3 = new Integer(45);

        $this->assertTrue($integer1->equals($integer2));
        $this->assertTrue($integer2->equals($integer1));
        $this->assertFalse($integer1->equals($integer3));

        $mock = $this->getMock('ValueObjects\ValueObjectInterface');
        $this->assertFalse($integer1->equals($mock));
    }

    public function testToString()
    {
        $integer = new Integer(87);
        $this->assertSame('87', $integer->__toString());
    }

    /** @expectedException ValueObjects\Exception\InvalidNativeArgumentException */
    public function testInvalidNativeArgument()
    {
        new Integer(23.4);
    }

    public function testZeroToString()
    {
        $zero = new Integer(0);
        $this->assertSame('0', $zero->__toString());
    }
}
