<?php

namespace ValueObjects\Tests\DateTime;

use ValueObjects\Tests\TestCase;
use ValueObjects\DateTime\WeekDay;

class WeekdayTest extends TestCase
{
    public function testNow()
    {
        $weekDay = WeekDay::now();
        $this->assertEquals(date('l'), $weekDay->getValue());
    }

    public function testFromNativeDateTime()
    {
        $nativeDateTime = new \DateTime();
        $nativeDateTime->setDate(2013, 12, 14);

        $weekDay = WeekDay::fromNativeDateTime($nativeDateTime);

        $this->assertEquals('Saturday', $weekDay->getValue());
    }

    public function testGetNumericValue()
    {
        $weekDay = WeekDay::SATURDAY();

        $this->assertEquals(6, $weekDay->getNumericValue());
    }

}
