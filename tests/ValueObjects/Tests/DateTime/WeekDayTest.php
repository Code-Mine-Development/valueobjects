<?php

namespace ValueObjects\Tests\DateTime;

use ValueObjects\Tests\TestCase;
use ValueObjects\DateTime\WeekDay;

class WeekdayTest extends TestCase
{
    public function testNow()
    {
        $weekDay = WeekDay::now();
        $this->assertEquals(date('N'), $weekDay->getValue());
    }

    /** @expectedException ValueObjects\DateTime\Exception\InvalidWeekDayException */
    public function testInvalidWeekDay()
    {
        new WeekDay(8);
    }

}
