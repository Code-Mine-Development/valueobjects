<?php

namespace ValueObjects\Tests\String;

use ValueObjects\Tests\TestCase;
use ValueObjects\String\String;

class StringTest extends TestCase
{
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

    public function testToString()
    {
        $foo = new String('foo');
        $this->assertEquals('foo', $foo->__toString());
    }
}