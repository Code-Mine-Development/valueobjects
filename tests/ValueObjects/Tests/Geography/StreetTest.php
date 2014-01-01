<?php

namespace ValueObjects\Tests\Geography;

use ValueObjects\Geography\Street;
use ValueObjects\String\String;
use ValueObjects\Tests\TestCase;

class StreetTest extends TestCase
{
    protected $street;

    public function setup()
    {
        $this->street = new Street(new String('Abbey Rd'), new String('3'));
    }

    public function testFromNative()
    {
        $fromNativeStreet  = Street::fromNative('Abbey Rd', '3');
        $this->assertTrue($this->street->equals($fromNativeStreet));
    }

    /** @expectedException \BadMethodCallException */
    public function testInvalidFromNative()
    {
        Street::fromNative('Abbey Rd');
    }

    public function testEquals()
    {
        $street2 = new Street(new String('Abbey Rd'), new String('3'));
        $street3 = new Street(new String('Orchard Road'), new String(''));

        $this->assertTrue($this->street->equals($street2));
        $this->assertTrue($street2->equals($this->street));
        $this->assertFalse($this->street->equals($street3));

        $mock = $this->getMock('ValueObjects\ValueObjectInterface');
        $this->assertFalse($this->street->equals($mock));
    }

    public function testGetName()
    {
        $name = new String('Abbey Rd');
        $this->assertTrue($this->street->getName()->equals($name));
    }

    public function testGetNumber()
    {
        $number = new String('3');
        $this->assertTrue($this->street->getNumber()->equals($number));
    }

    public function testToString()
    {
        $this->assertSame('3 Abbey Rd', $this->street->__toString());
    }
}