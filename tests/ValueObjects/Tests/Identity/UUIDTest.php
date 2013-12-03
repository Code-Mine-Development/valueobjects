<?php

namespace ValueObjects\Tests\Identity;

use ValueObjects\Identity\UUID;
use ValueObjects\Tests\TestCase;

class UUIDTest extends TestCase
{
    public function testEquals()
    {
        $uuid1 = new UUID();
        $uuid2 = clone $uuid1;
        $uuid3 = new UUID();

        $this->assertTrue($uuid1->equals($uuid2));
        $this->assertTrue($uuid2->equals($uuid1));
        $this->assertFalse($uuid1->equals($uuid3));

        $mock = $this->getMock('ValueObjects\ValueObjectInterface');
        $this->assertFalse($uuid1->equals($mock));
    }

    public function testValueFormat()
    {
        $uuid = new UUID();
        $this->assertRegExp('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/', $uuid->getValue());
    }
}