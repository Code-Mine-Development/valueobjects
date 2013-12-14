<?php

namespace ValueObjects\Tests\Number;

use ValueObjects\Person\Sex;
use ValueObjects\Tests\TestCase;

class SexTest extends TestCase
{
    public function testGetValue()
    {
        $sex = Sex::FEMALE();
        $this->assertEquals(Sex::FEMALE, $sex->getValue());
    }

    public function testEquals()
    {
        $male1 = Sex::MALE();
        $male2 = Sex::MALE();
        $other = Sex::OTHER();

        $this->assertTrue($male1->equals($male2));
        $this->assertTrue($male2->equals($male1));
        $this->assertFalse($male1->equals($other));

        $mock = $this->getMock('ValueObjects\ValueObjectInterface');
        $this->assertFalse($male1->equals($mock));
    }

    public function testToString()
    {
        $sex = Sex::FEMALE();
        $this->assertEquals('female', $sex->__toString());
    }
}
