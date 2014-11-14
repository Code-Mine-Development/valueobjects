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
        $this->street = new Street(new String('Abbey Rd'), new String('3'), new String('Building A'), new String('%number% %name%, %elements%'));
    }

    public function testFromNative()
    {
        $fromNativeStreet  = Street::fromNative('Abbey Rd', '3', 'Building A');
        $this->assertTrue($this->street->sameValueAs($fromNativeStreet));
    }

    /** @expectedException \BadMethodCallException */
    public function testInvalidFromNative()
    {
        Street::fromNative('Abbey Rd');
    }

    public function testSameValueAs()
    {
        $street2 = new Street(new String('Abbey Rd'), new String('3'), new String('Building A'));
        $street3 = new Street(new String('Orchard Road'), new String(''));

        $this->assertTrue($this->street->sameValueAs($street2));
        $this->assertTrue($street2->sameValueAs($this->street));
        $this->assertFalse($this->street->sameValueAs($street3));

        $mock = $this->getMock('ValueObjects\ValueObjectInterface');
        $this->assertFalse($this->street->sameValueAs($mock));
    }

    public function testGetName()
    {
        $name = new String('Abbey Rd');
        $this->assertTrue($this->street->getName()->sameValueAs($name));
    }

    public function testGetNumber()
    {
        $number = new String('3');
        $this->assertTrue($this->street->getNumber()->sameValueAs($number));
    }

    public function testGetElements()
    {
        $elements = new String('Building A');
        $this->assertTrue($this->street->getElements()->sameValueAs($elements));
    }

    public function testToString()
    {
        $this->assertSame('3 Abbey Rd, Building A', $this->street->__toString());
    }
}
