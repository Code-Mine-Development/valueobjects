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

        $this->assertTrue($string->equals($constructedString));
    }

    public function testGetValue()
    {
        $string = new String('foo');
        $this->assertEquals('foo', $string->getValue());
    }

    public function testEquals()
    {
        $foo1 = new String('foo');
        $foo2 = new String('foo');
        $bar = new String('bar');

        $this->assertTrue($foo1->equals($foo2));
        $this->assertTrue($foo2->equals($foo1));
        $this->assertFalse($foo1->equals($bar));

        $mock = $this->getMock('ValueObjects\ValueObjectInterface');
        $this->assertFalse($foo1->equals($mock));
    }

    /** @expectedException ValueObjects\Exception\InvalidNativeArgumentException */
    public function testInvalidNativeArgument()
    {
        new String(12);
    }

    public function testToString()
    {
        $foo = new String('foo');
        $this->assertEquals('foo', $foo->__toString());
    }
}