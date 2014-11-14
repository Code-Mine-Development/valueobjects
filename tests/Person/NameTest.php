<?php

namespace ValueObjects\Tests\String;

use ValueObjects\Person\Name;
use ValueObjects\Tests\TestCase;
use ValueObjects\String\String;

class NameTest extends TestCase
{
    private $name;

    public function setup()
    {
        $this->name = new Name(new String('foo'), new String('bar'), new String('baz'));
    }

    public function testFromNative()
    {
        $fromNativeName  = Name::fromNative('foo', 'bar', 'baz');

        $this->assertTrue($fromNativeName->sameValueAs($this->name));
    }

    public function testGetFirstName()
    {
        $this->assertEquals('foo', $this->name->getFirstName());
    }

    public function testGetMiddleName()
    {
        $this->assertEquals('bar', $this->name->getMiddleName());
    }

    public function testGetLastName()
    {
        $this->assertEquals('baz', $this->name->getLastName());
    }

    public function testGetFullName()
    {
        $this->assertEquals('foo bar baz', $this->name->getFullName());
    }

    public function testEmptyFullName()
    {
        $name = new Name(new String(''), new String(''), new String(''));

        $this->assertEquals('', $name->getFullName());
    }

    public function testSameValueAs()
    {
        $name2 = new Name(new String('foo'), new String('bar'), new String('baz'));
        $name3 = new Name(new String('foo'), new String(''), new String('baz'));

        $this->assertTrue($this->name->sameValueAs($name2));
        $this->assertTrue($name2->sameValueAs($this->name));
        $this->assertFalse($this->name->sameValueAs($name3));

        $mock = $this->getMock('ValueObjects\ValueObjectInterface');
        $this->assertFalse($this->name->sameValueAs($mock));
    }

    public function testToString()
    {
        $this->assertEquals('foo bar baz', $this->name->__toString());
    }
}
