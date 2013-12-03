<?php

namespace ValueObjects\Tests\Number;

use ValueObjects\Person\Sex;
use ValueObjects\Tests\TestCase;

class SexTest extends TestCase
{
    public function testSexValue()
    {
        $sex = new Sex(Sex::FEMALE);
        $this->assertEquals(Sex::FEMALE, $sex->getValue());
    }

    public function testEquals()
    {
        $male1 = new Sex(Sex::MALE);
        $male2 = new Sex(Sex::MALE);
        $other = new Sex(Sex::OTHER);

        $this->assertTrue($male1->equals($male2));
        $this->assertTrue($male2->equals($male1));
        $this->assertFalse($male1->equals($other));

        $mock = $this->getMock('ValueObjects\ValueObjectInterface');
        $this->assertFalse($male1->equals($mock));
    }

    public function testToString()
    {
        $sex = new Sex(Sex::FEMALE);
        $this->assertEquals('female', $sex->__toString());
    }

    /**
     * @expectedException ValueObjects\Person\Exception\InvalidSexException
     */
    public function testInvalidSex()
    {
        new Sex('foo');
    }
}
