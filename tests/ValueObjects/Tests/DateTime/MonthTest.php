<?php

namespace ValueObjects\Tests\DateTime;

use ValueObjects\Tests\TestCase;
use ValueObjects\DateTime\Month;

class MonthTest extends TestCase
{
    public function testNow()
    {
        $month = Month::now();
        $this->assertEquals(date('F'), $month->getValue());
    }

    public function testFromNativeDateTime()
    {
        $nativeDateTime = new \DateTime();
        $nativeDateTime->setDate(2013, 12, 1);

        $month = Month::fromNativeDateTime($nativeDateTime);

        $this->assertEquals('December', $month->getValue());
    }

    public function testGetNumericValue()
    {
        $month = Month::APRIL();

        $this->assertEquals(4, $month->getNumericValue());
    }

}
