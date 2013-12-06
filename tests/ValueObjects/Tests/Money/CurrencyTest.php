<?php

namespace ValueObjects\Tests\Money;

use ValueObjects\Money\CurrencyCode;
use ValueObjects\Tests\TestCase;
use ValueObjects\Money\Currency;

class CurrencyTest extends TestCase
{
    public function testEquals()
    {
        $eur1 = new Currency(CurrencyCode::EUR());
        $eur2 = new Currency(CurrencyCode::EUR());
        $usd  = new Currency(CurrencyCode::USD());

        $this->assertTrue($eur1->equals($eur2));
        $this->assertTrue($eur2->equals($eur1));
        $this->assertFalse($eur1->equals($usd));

        $mock = $this->getMock('ValueObjects\ValueObjectInterface');
        $this->assertFalse($eur1->equals($mock));
    }

    public function testGetCode()
    {
        $cad = new Currency(CurrencyCode::CAD());

        $this->assertInstanceOf('\ValueObjects\Money\CurrencyCode', $cad->getCode());
        $this->assertSame('CAD', $cad->getCode()->getValue());
    }

    public function testToString()
    {
        $eur = new Currency(CurrencyCode::EUR());

        $this->assertSame('EUR', $eur->__toString());
    }
}