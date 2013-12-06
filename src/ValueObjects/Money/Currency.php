<?php

namespace ValueObjects\Money;

use Money\Currency as BaseCurrency;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

class Currency implements ValueObjectInterface
{
    /** @var BaseCurrency */
    protected $currency;

    /** @var CurrencyCode  */
    protected $code;

    public function __construct(CurrencyCode $code)
    {
        $this->code     = $code;
        $this->currency = new BaseCurrency($code->getValue());
    }

    /**
     * Tells whether two Currency are equal by comparing their names
     *
     * @param  ValueObjectInterface $currency
     * @return bool
     */
    public function equals(ValueObjectInterface $currency)
    {
        if (false === Util::classEquals($this, $currency)) {
            return false;
        }

        return $this->getCode()->getValue() == $currency->getCode()->getValue();
    }

    /**
     * Returns currency code
     *
     * @return CurrencyCode
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Returns string representation of the currency
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getCode()->getValue();
    }
}
