<?php

namespace ValueObjects\Tests\Number;

use ValueObjects\Person\Age;
use ValueObjects\Tests\TestCase;

class AgeTest extends TestCase
{
    public function testGetValue()
    {
        $age = new Age(25);
        $this->assertEquals(25, $age->getValue());
    }

    public function testEquals()
    {
        $age1 = new Age(33);
        $age2 = new Age(33);

        $this->assertTrue($age1->equals($age2));
        $this->assertTrue($age2->equals($age1));
    }

    public function testToString()
    {
        $age = new Age(54);
        $this->assertEquals('54', $age->__toString());
    }

    /**
     * @expectedException ValueObjects\Person\Exception\InvalidAgeException
     */
    public function testInvalidAge()
    {
        new Age(-3);
    }
}
