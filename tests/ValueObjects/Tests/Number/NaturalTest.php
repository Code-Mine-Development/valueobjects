<?php

namespace ValueObjects\Tests\Number;

use ValueObjects\Number\Natural;
use ValueObjects\Number\Integer;
use ValueObjects\Number\Real;
use ValueObjects\Tests\TestCase;

class NaturalTest extends TestCase
{
    /** @expectedException ValueObjects\Exception\InvalidNativeArgumentException */
    public function testInvalidNativeArgument()
    {
        new Natural(-2);
    }

    public function testToInteger()
    {
        $natural       = new Natural(12);
        $nativeInteger = new Integer(12);
        $integer       = $natural->toInteger();

        $this->assertTrue($integer->equals($nativeInteger));
    }

    public function testToReal()
    {
        $natural    = new Natural(12);
        $nativeReal = new Real(12);
        $real       = $natural->toReal();

        $this->assertTrue($real->equals($nativeReal));
    }
}
