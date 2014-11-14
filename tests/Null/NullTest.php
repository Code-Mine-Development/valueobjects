<?php

namespace ValueObjects\Tests\Null;

use ValueObjects\Tests\TestCase;
use ValueObjects\Null\Null;

class NullTest extends TestCase
{
    /** @expectedException \BadMethodCallException */
    public function testFromNative()
    {
        Null::fromNative();
    }

    public function testSameValueAs()
    {
        $null1 = new Null();
        $null2 = new Null();

        $this->assertTrue($null1->sameValueAs($null2));
    }

    public function testCreate()
    {
        $null = Null::create();

        $this->assertInstanceOf('ValueObjects\Null\Null', $null);
    }

    public function testToString()
    {
        $foo = new Null();
        $this->assertSame('', $foo->__toString());
    }
}
