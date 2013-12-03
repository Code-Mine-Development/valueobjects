<?php

namespace ValueObjects\Tests\DateTime;

use ValueObjects\Tests\TestCase;
use ValueObjects\DateTime\MonthDay;

class MonthDayTest extends TestCase
{
    public function testNow()
    {
        $monthDay = MonthDay::now();
        $this->assertEquals(date('j'), $monthDay->getValue());
    }

    /** @expectedException ValueObjects\DateTime\Exception\InvalidMonthDayException */
    public function testInvalidMonthDay()
    {
        new MonthDay(32);
    }

}
