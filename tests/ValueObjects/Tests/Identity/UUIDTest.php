<?php

namespace ValueObjects\Tests\Identity;

use ValueObjects\Identity\UUID;
use ValueObjects\Tests\TestCase;

class UUIDTest extends TestCase
{
    public function testFromNative()
    {
        $uuid1 = new UUID();
        $uuid2 = UUID::fromNative($uuid1->toNative());

        $this->assertTrue($uuid1->sameValueAs($uuid2));
    }

    public function testSameValueAs()
    {
        $uuid1 = new UUID();
        $uuid2 = clone $uuid1;
        $uuid3 = new UUID();

        $this->assertTrue($uuid1->sameValueAs($uuid2));
        $this->assertTrue($uuid2->sameValueAs($uuid1));
        $this->assertFalse($uuid1->sameValueAs($uuid3));

        $mock = $this->getMock('ValueObjects\ValueObjectInterface');
        $this->assertFalse($uuid1->sameValueAs($mock));
    }

    /** @expectedException ValueObjects\Exception\InvalidNativeArgumentException */
    public function testInvalid()
    {
        new UUID('invalid');
    }
}