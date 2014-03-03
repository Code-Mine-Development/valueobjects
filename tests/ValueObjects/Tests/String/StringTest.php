<?php

namespace ValueObjects\Tests\String;

use ValueObjects\Tests\TestCase;
use ValueObjects\String\String;

class StringTest extends TestCase
{
    public function testFromNative()
    {
        $string = String::fromNative('foo');
        $constructedString = new String('foo');

        $this->assertTrue($string->sameValueAs($constructedString));
    }

    public function testToNative()
    {
        $string = new String('foo');
        $this->assertEquals('foo', $string->toNative());
    }

    public function testSameValueAs()
    {
        $foo1 = new String('foo');
        $foo2 = new String('foo');
        $bar = new String('bar');

        $this->assertTrue($foo1->sameValueAs($foo2));
        $this->assertTrue($foo2->sameValueAs($foo1));
        $this->assertFalse($foo1->sameValueAs($bar));

        $mock = $this->getMock('ValueObjects\ValueObjectInterface');
        $this->assertFalse($foo1->sameValueAs($mock));
    }

    /** @expectedException ValueObjects\Exception\InvalidNativeArgumentException */
    public function testInvalidNativeArgument()
    {
        new String(12);
    }

    public function testIsEmpty()
    {
        $string = new String('');

        $this->assertTrue($string->isEmpty());
    }

    public function testToString()
    {
        $foo = new String('foo');
        $this->assertEquals('foo', $foo->__toString());
    }
}
