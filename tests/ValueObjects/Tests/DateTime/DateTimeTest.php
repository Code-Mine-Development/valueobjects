<?php

namespace ValueObjects\Tests\DateTime;

use ValueObjects\DateTime\Date;
use ValueObjects\DateTime\Month;
use ValueObjects\DateTime\MonthDay;
use ValueObjects\DateTime\Time;
use ValueObjects\DateTime\Year;
use ValueObjects\Tests\TestCase;
use ValueObjects\DateTime\DateTime;

class DateTimeTest extends TestCase
{
    public function testFromNativeDateTime()
    {
        $nativeDateTime      = new \DateTime('now');
        $dateTimeFromNative  = DateTime::fromNativeDateTime($nativeDateTime);
        $constructedDateTime = new DateTime($nativeDateTime->format('Y'), $nativeDateTime->format('m'), $nativeDateTime->format('d'), $nativeDateTime->format('G'), $nativeDateTime->format('i'), $nativeDateTime->format('s'));

        $this->assertTrue($dateTimeFromNative->equals($constructedDateTime));
    }

    public function testNow()
    {
        $dateTime = DateTime::now();
        $this->assertEquals(date('Y-n-j G:i:s'), \strval($dateTime));
    }

    /** @expectedException ValueObjects\DateTime\Exception\InvalidDateTimeException */
    public function testInvalidDateException()
    {
        new DateTime(2013, 13, 2, 24, 30, 1);
    }

    /** @expectedException ValueObjects\DateTime\Exception\InvalidDateTimeException */
    public function testAlmostValidDateTimeException()
    {
        new DateTime(2013, 2, 28, 64, 20, 20);
    }

    public function testEquals()
    {
        $dateTime1 = new DateTime(2013, 12, 3, 20, 20, 30);
        $dateTime2 = new DateTime(2013, 12, 3, 20, 20, 30);
        $dateTime3 = new DateTime(2013, 12, 4, 20, 21, 30);

        $this->assertTrue($dateTime1->equals($dateTime2));
        $this->assertTrue($dateTime2->equals($dateTime1));
        $this->assertFalse($dateTime1->equals($dateTime3));

        $mock = $this->getMock('ValueObjects\ValueObjectInterface');
        $this->assertFalse($dateTime1->equals($mock));
    }

    public function testGetDate()
    {
        $dateTime = new DateTime(2013, 12, 3);
        $date     = new Date(2013, 12, 3);

        $this->assertTrue($date->equals($dateTime->getDate()));
    }

    public function testGetTime()
    {
        $dateTime = new DateTime(2013, 12, 3, 20, 40, 10);
        $time     = new Time(20, 40, 10);

        $this->assertTrue($time->equals($dateTime->getTime()));
    }

    public function testToNativeDateTime()
    {
        $dateTime       = new DateTime(2013, 12, 3, 20, 40, 10);
        $nativeDateTime = \DateTime::createFromFormat('Y-n-j H:i:s', '2013-12-3 20:40:10');

        $this->assertEquals($nativeDateTime, $dateTime->toNativeDateTime());
    }

    public function testToString()
    {
        $date = new DateTime(2013, 12, 3, 20, 40, 10);
        $this->assertEquals('2013-12-3 20:40:10', $date->__toString());
    }

}
