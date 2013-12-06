<?php

namespace ValueObjects\Number;

use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

class Real implements ValueObjectInterface, NumberInterface
{
    protected $value;

    public function __construct($value)
    {
        $this->value = \floatval($value);
    }

    /**
     * Returns the value of the real number
     *
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Tells whether two Real are equal by comparing their values
     *
     * @param  ValueObjectInterface $real
     * @return bool
     */
    public function equals(ValueObjectInterface $real)
    {
        if (false === Util::classEquals($this, $real)) {
            return false;
        }

        return $this->getValue() === $real->getValue();
    }

    /**
     * Returns the string representation of the real value
     *
     * @return string
     */
    public function __toString()
    {
        return \strval($this->getValue());
    }
}
