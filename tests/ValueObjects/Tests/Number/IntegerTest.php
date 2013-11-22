<?php

namespace ValueObjects\Tests\Number;

use ValueObjects\Tests\TestCase;
use ValueObjects\Number\Integer;

class IntegerTest extends TestCase
{
    public function testGetValue()
    {
        $integer = new Integer(5);
        $this->assertEquals($integer->getValue(), 5);
    }

    public function testEquals()
    {
        $integer1 = new Integer(3);
        $integer2 = new Integer(3);

        $this->assertTrue($integer1->equals($integer2));
        $this->assertTrue($integer2->equals($integer1));
    }

    public function testToString()
    {
        $integer = new Integer(87);
        $this->assertEquals($integer->__toString(), '87');
    }

    public function testZeroToString()
    {
        $zero = new Integer(0);
        $this->assertEquals($zero->__toString(), '0');
    }
}