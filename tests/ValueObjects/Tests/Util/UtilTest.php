<?php

namespace ValueObjects\Tests\Util;

use ValueObjects\Tests\TestCase;
use ValueObjects\Util\Util;

class UtilTest extends TestCase
{
    public function testClasssameValueAs()
    {
        $util1 = new Util();
        $util2 = new Util();

        $this->assertTrue(Util::classsameValueAs($util1, $util2));
        $this->assertFalse(Util::classsameValueAs($util1, $this));
    }

    public function testGetClassAsString()
    {
        $util = new Util();
        $this->assertEquals('ValueObjects\Util\Util', Util::getClassAsString($util));
    }

}