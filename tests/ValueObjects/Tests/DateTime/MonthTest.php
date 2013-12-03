<?php

namespace ValueObjects\Tests\DateTime;

use ValueObjects\Tests\TestCase;
use ValueObjects\DateTime\Month;

class MonthTest extends TestCase
{
    public function testNow()
    {
        $month = Month::now();
        $this->assertEquals(date('n'), $month->getValue());
    }

    /** @expectedException ValueObjects\DateTime\Exception\InvalidMonthException */
    public function testInvalidMonth()
    {
        new Month(13);
    }

}
