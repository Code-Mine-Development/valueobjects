<?php

namespace ValueObjects\Tests\Number;

use ValueObjects\StringLiteral\StringLiteral;
use ValueObjects\Tests\TestCase;
use ValueObjects\Number\Real;
use ValueObjects\Number\Integer;
use ValueObjects\Number\Natural;

class RealTest extends TestCase
{
    public function testJsonSerialize()
    {
        $dataForJson = [
            'real' => new Real(3)
        ];

        $json = json_encode($dataForJson);

        $this->assertSame('{"real":3}', $json);
    }
    
    public function testFromNative()
    {
        $fromNativeReal  = Real::fromNative(.056);
        $constructedReal = new Real(.056);

        $this->assertTrue($fromNativeReal->sameValueAs($constructedReal));
    }

    public function testToNative()
    {
        $real = new Real(3.4);
        $this->assertEquals(3.4, $real->toNative());
    }

    public function testSameValueAs()
    {
        $real1 = new Real(5.64);
        $real2 = new Real(5.64);
        $real3 = new Real(6.01);

        $this->assertTrue($real1->sameValueAs($real2));
        $this->assertTrue($real2->sameValueAs($real1));
        $this->assertFalse($real1->sameValueAs($real3));

        $mock = $this->getMock('ValueObjects\ValueObjectInterface');
        $this->assertFalse($real1->sameValueAs($mock));
    }

    /** @expectedException ValueObjects\Exception\InvalidNativeArgumentException */
    public function testInvalidNativeArgument()
    {
        new Real('invalid');
    }

    public function testToInteger()
    {
        $real          = new Real(3.14);
        $nativeInteger = new Integer(3);
        $integer       = $real->toInteger();

        $this->assertTrue($integer->sameValueAs($nativeInteger));
    }

    public function testToNatural()
    {
        $real          = new Real(3.14);
        $nativeNatural = new Natural(3);
        $natural       = $real->toNatural();

        $this->assertTrue($natural->sameValueAs($nativeNatural));
    }

    public function testToString()
    {
        $real = new Real(.7);
        $this->assertEquals('.7', $real->__toString());
    }


    
     
     
     
     
    public function testAdd()
    {
        $real = new Real(5);
        $add = new Real(5);

        $result = new Real(10);

        $this->assertTrue($result->sameValueAs($real->add($add)));
    }

    
     
     
     
     
    public function testSubtract()
    {
        $real = new Real(10);
        $sub = new Real(5);

        $result = new Real(5);

        $this->assertTrue($result->sameValueAs($real->subtract($sub)));



    }

    
     
     
     
     
    public function testMultiply()
    {
        $real = new Real(10);
        $operator = new Real(5);

        $result = new Real(50);

        $this->assertTrue($result->sameValueAs($real->multiply($operator)));

    }

    
     
     
     
     
    public function testDivide()
    {

        $real = new Real(1);
        $operator = new Real(2);

        $result = new Real(0.5);

        $this->assertEquals($result,$real->divide($operator));
    }

    
     
     
     
     
    public function testToPower()
    {
        $real = new Real(2);
        $operator = new Real(3);

        $result = new Real(8);

        $this->assertTrue($result->sameValueAs($real->toPower($operator)));
    }

    
     
     
    public function testSquare()
    {
        $real = new Real(3);

        $result = new Real(9);

        $this->assertEquals($result,$real->square());
    }

    
     
     
    public function testSquareRoot()
    {
        $real = new Real(9);

        $result = new Real(3);

        $this->assertEquals($result,$real->squareRoot());
    }


    
     
     
    public function testCube()
    {
        $real = new Real(3);

        $result = new Real(27);

        $this->assertEquals($result,$real->cube());
    }

    
     
     
    public function testIsEven()
    {
        $real = new Real(2);

        $this->assertTrue($real->isEven());
    }

    
     
     
    public function testIsOdd()
    {
        $real = new Real(3);

        $this->assertTrue($real->isOdd());
    }

    
     
     
    public function testFactorial()
    {
        $real = new Real(5);

        $result = new Real(120);

        $this->assertEquals($result,$real->factorial());
    }

    
     
     
     
     
    public function testIsGreaterThan()
    {
        $real = new Real(5);

        $compare = new Real(2);

        $this->assertTrue($real->isGreaterThan($compare));
        $this->assertFalse($real->isLessThan($compare));
    }

    
     
     
     
     
    public function testIsGreaterOrEqual()
    {
        $real = new Real(5);

        $compare = new Real(5);

        $this->assertTrue($real->isGreaterOrEqual($compare));
    }
     
     
    public function testIsLessThan()
    {
        $real = new Real(2);

        $compare = new Real(5);

        $this->assertFalse($real->isGreaterThan($compare));
        $this->assertTrue($real->isLessThan($compare));
    }

    
     
     
     
     
    public function testisLessOrEqual()
    {
        $real = new Real(5);

        $compare = new Real(5);

        $this->assertTrue($real->isLessOrEqual($compare));
    }

    
     
     
     
     
    public function testModulo()
    {
        $real = new Real(40);
        $operator = new Real(3);

        $result = new Real(1);

        $this->assertEquals($result, $real->modulo($operator));

    }

    
     
     
    public function testIsZero()
    {
        $real = new Real(0);
        $this->assertTrue($real->isZero());

        $real = new Real(1);
        $this->assertFalse($real->isZero());


    }

    
     
     
    public function testIsPositive()
    {
        $real = new Real(1);
        $this->assertTrue($real->isPositive());

        $real = new Real(-1);
        $this->assertFalse($real->isPositive());
    }

    
     
     
    public function testIsNegative()
    {
        $real = new Real(-1);
        $this->assertTrue($real->isNegative());

        $real = new Real(1);
        $this->assertFalse($real->isNegative());
    }

    
     
     
    public function testDigits()
    {

        $real = new Real(40);
        $result = new Real(2);
        $this->assertEquals($result, $real->digits());
    }

    
     
     
    public function testInverse()
    {
        $real = new Real(40);
        $result = new Real(-40);
        $this->assertEquals($result, $real->inverse());
    }

    public function testIncrement()
    {
        $real = new Real(40);
        $result = new Real(41);
        $this->assertEquals($result, $real->increment());
    }

    public function testDecrement()
    {
        $real = new Real(40);
        $result = new Real(39);
        $this->assertEquals($result, $real->decrement());
    }

    public function testBy10()
    {
        $real = new Real(40);
        $result = new Real(4);
        $this->assertEquals($result, $real->by10());
    }

    public function testBy100()
    {
        $real = new Real(40);
        $result = new Real(0.4);
        $this->assertEquals($result, $real->by100());
    }

    public function testScientific()
    {
        $real = new Real(3453);
        $result = new StringLiteral('3.453000e+3');

        $this->assertEquals($result, $real->scientific());
    }

    public function testZero()
    {
        $result = new Real(0);
        $this->assertEquals($result, Real::zero());
    }

    public function testAbsolute()
    {
        $real = new Real(-40);
        $result = new Real(40);
        $this->assertEquals($result, $real->absolute());

        $real = new Real(40);
        $result = new Real(40);
        $this->assertEquals($result, $real->absolute());
    }
}
