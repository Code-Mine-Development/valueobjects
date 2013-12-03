<?php

namespace ValueObjects\Tests\DateTime;

use ValueObjects\Tests\TestCase;
use ValueObjects\DateTime\Hour;

class HourTest extends TestCase
{
    public function testNow()
    {
        $hour = Hour::now();
        $this->assertEquals(date('G'), $hour->getValue());
    }

    /** @expectedException ValueObjects\DateTime\Exception\InvalidHourException */
    public function testInvalidHour()
    {
        new Hour(24);
    }

}
