<?php

namespace ValueObjects\Tests\DateTime;

use ValueObjects\Tests\TestCase;
use ValueObjects\DateTime\Minute;

class MinuteTest extends TestCase
{
    public function testNow()
    {
        $minute = Minute::now();
        $this->assertEquals(\intval(date('i')), $minute->getValue());
    }

    /** @expectedException ValueObjects\DateTime\Exception\InvalidMinuteException */
    public function testInvalidMinute()
    {
        new Minute(60);
    }

}
