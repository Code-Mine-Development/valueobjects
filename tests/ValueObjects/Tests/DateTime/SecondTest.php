<?php

namespace ValueObjects\Tests\DateTime;

use ValueObjects\Tests\TestCase;
use ValueObjects\DateTime\Second;

class SecondTest extends TestCase
{
    public function testNow()
    {
        $second = Second::now();
        $this->assertEquals(\intval(date('s')), $second->getValue());
    }

    /** @expectedException ValueObjects\DateTime\Exception\InvalidSecondException */
    public function testInvalidSecond()
    {
        new Second(60);
    }

}
