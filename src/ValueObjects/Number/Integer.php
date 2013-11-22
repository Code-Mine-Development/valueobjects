<?php

namespace ValueObjects\Number;

use ValueObjects\ValueObject;

class Integer extends ValueObject
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Returns the value of the integer
     *
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Tells whether two integer are equal by comparing their values
     *
     * @param ValueObject $integer
     * @return bool
     */
    public function equals(ValueObject $integer)
    {
        if(false === parent::equals($integer)) {
            return false;
        }

        return $this->getValue() === $integer->getValue();
    }

    /**
     * Returns the string representation of the integer value
     *
     * @return string
     */
    public function __toString()
    {
        return \strval($this->value);
    }
}