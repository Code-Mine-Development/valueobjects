<?php

namespace ValueObjects\Tests\DateTime;

use ValueObjects\DateTime\Minute;
use ValueObjects\DateTime\Second;
use ValueObjects\DateTime\Hour;
use ValueObjects\Tests\TestCase;
use ValueObjects\DateTime\Time;

class TimeTest extends TestCase
{
    public function testFromNativeDateTime()
    {
        $nativeTime = new \DateTime('today');
        $timeFromNative = Time::fromNativeDateTime($nativeTime);
        $constructedTime = new Time($nativeTime->format('G'), $nativeTime->format('i'), $nativeTime->format('s'));

        $this->assertTrue($timeFromNative->equals($constructedTime));
    }

    public function testNow()
    {
        $time = Time::now();
        $this->assertEquals(date('G:i:s'), \strval($time));
    }

    /** @expectedException ValueObjects\DateTime\Exception\InvalidTimeException */
    public function testInvalidTimeException()
    {
        new Time(10, 20, 76);
    }

    public function testEquals()
    {
        $time1 = new Time(10, 20, 0);
        $time2 = new Time(10, 20, 0);
        $time3 = new Time(10, 1, 10);

        $this->assertTrue($time1->equals($time2));
        $this->assertTrue($time2->equals($time1));
        $this->assertFalse($time1->equals($time3));

        $mock = $this->getMock('ValueObjects\ValueObjectInterface');
        $this->assertFalse($time1->equals($mock));
    }

    public function testGetHour()
    {
        $time = new Time(10, 20, 0);
        $hour = new Hour(10);

        $this->assertTrue($hour->equals($time->getHour()));
    }

    public function testGetMinute()
    {
        $time  = new Time(10, 20, 0);
        $minute = new Minute(20);

        $this->assertTrue($minute->equals($time->getMinute()));
    }

    public function testGetDay()
    {
        $time = new Time(10, 20, 0);
        $day  = new Second(0);

        $this->assertTrue($day->equals($time->getSecond()));
    }

    public function testToNativeDateTime()
    {
        $time = new Time(10, 20, 0);
        $nativeTime = \DateTime::createFromFormat('H:i:s', '10:20:00');

        $this->assertEquals($nativeTime, $time->toNativeDateTime());
    }

    public function testToString()
    {
        $time = new Time(10, 20, 0);;
        $this->assertEquals('10:20:00', $time->__toString());
    }

}
