<?php

namespace ValueObjects\Tests\Number;

use ValueObjects\Person\Gender;
use ValueObjects\Tests\TestCase;

class GenderTest extends TestCase
{
    public function testGetValue()
    {
        $gender = Gender::FEMALE();
        $this->assertEquals(Gender::FEMALE, $gender->getValue());
    }

    public function testEquals()
    {
        $male1 = Gender::MALE();
        $male2 = Gender::MALE();
        $other = Gender::OTHER();

        $this->assertTrue($male1->equals($male2));
        $this->assertTrue($male2->equals($male1));
        $this->assertFalse($male1->equals($other));

        $mock = $this->getMock('ValueObjects\ValueObjectInterface');
        $this->assertFalse($male1->equals($mock));
    }

    public function testToString()
    {
        $sex = Gender::FEMALE();
        $this->assertEquals('female', $sex->__toString());
    }
}
