<?php

namespace ValueObjects\Tests\Geography;

use ValueObjects\Geography\Address;
use ValueObjects\Geography\Country;
use ValueObjects\Geography\CountryCode;
use ValueObjects\Geography\Street;
use ValueObjects\String\String;
use ValueObjects\Tests\TestCase;

class AddressTest extends TestCase
{
    /** @var Address */
    protected $address;

    public function setup()
    {
        $this->address = new Address(
            new String('Nicolò Pignatelli'),
            new Street(new String('via Manara'), new String('3')),
            new String(''),
            new String('Altamura'),
            new String('BARI'),
            new String('70022'),
            new Country(CountryCode::IT())
        );
    }

    public function testFromNative()
    {
        $fromNativeAddress = Address::fromNative('Nicolò Pignatelli', 'via Manara', '3', '', 'Altamura', 'BARI', '70022', 'IT');
        $this->assertTrue($this->address->equals($fromNativeAddress));
    }

    /** @expectedException \BadMethodCallException */
    public function testInvalidFromNative()
    {
        Address::fromNative('invalid');
    }

    public function testEquals()
    {
        $address2 = new Address(
            new String('Nicolò Pignatelli'),
            new Street(new String('via Manara'), new String('3')),
            new String(''),
            new String('Altamura'),
            new String('BARI'),
            new String('70022'),
            new Country(CountryCode::IT())
        );

        $address3 = new Address(
            new String('Nicolò Pignatelli'),
            new Street(new String('SP159'), new String('km 4')),
            new String(''),
            new String('Altamura'),
            new String('BARI'),
            new String('70022'),
            new Country(CountryCode::IT())
        );

        $this->assertTrue($this->address->equals($address2));
        $this->assertTrue($address2->equals($this->address));
        $this->assertFalse($this->address->equals($address3));

        $mock = $this->getMock('ValueObjects\ValueObjectInterface');
        $this->assertFalse($this->address->equals($mock));
    }

    public function testGetName()
    {
        $name = new String('Nicolò Pignatelli');
        $this->assertTrue($this->address->getName()->equals($name));
    }

    public function testGetStreet()
    {
        $street = new Street(new String('via Manara'), new String('3'));
        $this->assertTrue($this->address->getStreet()->equals($street));
    }

    public function testGetDistrict()
    {
        $district = new String('');
        $this->assertTrue($this->address->getDistrict()->equals($district));
    }

    public function testGetCity()
    {
        $city = new String('Altamura');
        $this->assertTrue($this->address->getCity()->equals($city));
    }

    public function testGetRegion()
    {
        $region = new String('BARI');
        $this->assertTrue($this->address->getRegion()->equals($region));
    }

    public function testGetPostalCode()
    {
        $code = new String('70022');
        $this->assertTrue($this->address->getPostalCode()->equals($code));
    }

    public function testGetCountry()
    {
        $country = new Country(CountryCode::IT());
        $this->assertTrue($this->address->getCountry()->equals($country));
    }

    public function testToString()
    {
        $addressString = <<<ADDR
Nicolò Pignatelli
3 via Manara
Altamura BARI 70022
Italy
ADDR;

        $this->assertSame($addressString, $this->address->__toString());
    }
}