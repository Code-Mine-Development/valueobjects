<?php

namespace ValueObjects\Number;

use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

class Float implements ValueObjectInterface
{
    protected $value;

    public function __construct($value)
    {
        $this->value = floatval($value);
    }

    /**
     * Returns the value of the floating point number
     *
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Tells whether two floats are equal by comparing their values
     *
     * @param  ValueObjectInterface $float
     * @return bool
     */
    public function equals(ValueObjectInterface $float)
    {
        if (false === Util::classEquals($this, $float)) {
            return false;
        }

        return $this->getValue() === $float->getValue();
    }

    /**
     * Returns the string representation of the float value
     *
     * @return string
     */
    public function __toString()
    {
        return \strval($this->getValue());
    }
}
