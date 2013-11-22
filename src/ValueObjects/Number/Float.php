<?php

namespace ValueObjects\Number;

use ValueObjects\ValueObject;

class Float extends ValueObject
{
    private $value;

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
     * @param ValueObject $float
     * @return bool
     */
    public function equals(ValueObject $float)
    {
        if(false === parent::equals($float)) {
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
        return \strval($this->value);
    }
}