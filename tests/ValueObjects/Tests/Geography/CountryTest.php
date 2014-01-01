<?php

namespace ValueObjects\Tests\Geography;

use ValueObjects\Geography\Country;
use ValueObjects\Geography\CountryCode;
use ValueObjects\String\String;
use ValueObjects\Tests\TestCase;

class CountryTest extends TestCase
{
    public function testFromNative()
    {
        $fromNativeCountry  = Country::fromNative('IT');
        $constructedCountry = new Country(CountryCode::IT());

        $this->assertTrue($constructedCountry->equals($fromNativeCountry));
    }

    public function testEquals()
    {
        $country1 = new Country(CountryCode::IT());
        $country2 = new Country(CountryCode::IT());
        $country3 = new Country(CountryCode::US());

        $this->assertTrue($country1->equals($country2));
        $this->assertTrue($country2->equals($country1));
        $this->assertFalse($country1->equals($country3));

        $mock = $this->getMock('ValueObjects\ValueObjectInterface');
        $this->assertFalse($country1->equals($mock));
    }

    public function testGetCode()
    {
        $italy = new Country(CountryCode::IT());
        $this->assertTrue($italy->getCode()->equals(CountryCode::IT()));
    }

    public function testGetName()
    {
        $italy = new Country(CountryCode::IT());
        $name  = new String('Italy');
        $this->assertTrue($italy->getName()->equals($name));
    }

    public function testToString()
    {
        $italy = new Country(CountryCode::IT());
        $this->assertSame('Italy', $italy->__toString());
    }
}