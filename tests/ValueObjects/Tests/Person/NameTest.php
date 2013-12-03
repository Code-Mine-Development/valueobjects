<?php

namespace ValueObjects\Tests\String;

use ValueObjects\Person\Name;
use ValueObjects\Tests\TestCase;
use ValueObjects\String\String;

class PersonTest extends TestCase
{
    public function testGetFirstName()
    {
        $name = new Name('foo', 'bar', 'baz');
        $this->assertEquals('foo', $name->getFirstName());
    }

    public function testGetMiddleName()
    {
        $name = new Name('foo', 'bar', 'baz');
        $this->assertEquals('bar', $name->getMiddleName());
    }

    public function testGetLastName()
    {
        $name = new Name('foo', 'bar', 'baz');
        $this->assertEquals('baz', $name->getLastName());
    }

    public function testGetFullName()
    {
        $name = new Name('foo', 'bar', 'baz');
        $this->assertEquals('foo bar baz', $name->getFullName());
    }

    public function testEquals()
    {
        $name1 = new Name('foo', 'bar', 'baz');
        $name2 = new Name('foo', 'bar', 'baz');
        $name3 = new Name('foo', '', 'baz');

        $this->assertTrue($name1->equals($name2));
        $this->assertTrue($name2->equals($name1));
        $this->assertFalse($name1->equals($name3));

        $mock = $this->getMock('ValueObjects\ValueObjectInterface');
        $this->assertFalse($name1->equals($mock));
    }

    public function testToString()
    {
        $foo = new Name('foo', 'bar', 'baz');
        $this->assertEquals('foo bar baz', $foo->__toString());
    }
}