<?php

namespace ValueObjects\Tests\DateTime;

use ValueObjects\Tests\TestCase;
use ValueObjects\DateTime\MonthDay;

class MonthDayTest extends TestCase
{
    public function fromNative()
    {
        $fromNativeMonthDay  = MonthDay::fromNative(15);
        $constructedMonthDay = new MonthDay(15);

        $this->assertTrue($fromNativeMonthDay->equals($constructedMonthDay));
    }

    public function testNow()
    {
        $monthDay = MonthDay::now();
        $this->assertEquals(date('j'), $monthDay->getValue());
    }

    /** @expectedException ValueObjects\Exception\InvalidNativeArgumentException */
    public function testInvalidMonthDay()
    {
        new MonthDay(32);
    }

}
