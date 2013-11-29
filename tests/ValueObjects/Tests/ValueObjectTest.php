<?php

namespace ValueObjects\Tests;

class ValueObjectTest extends TestCase
{
    public function testEquals()
    {
        $stub1 = $this->getMockForAbstractClass('ValueObjects\ValueObject');
        $stub2 = $this->getMockForAbstractClass('ValueObjects\ValueObject');

        $this->assertTrue($stub1->equals($stub2));
        $this->assertTrue($stub2->equals($stub1));

        eval('abstract class TestValueObject extends ValueObjects\ValueObject {}');
        $stub3 = $this->getMockForAbstractClass('TestValueObject');
        $this->assertFalse($stub1->equals($stub3));
    }

    public function testToString()
    {
        $stub = $this->getMockForAbstractClass('ValueObjects\ValueObject');
        $this->assertRegExp('/^Mock_ValueObject_\w{8}$/', $stub->__toString());
    }
}
