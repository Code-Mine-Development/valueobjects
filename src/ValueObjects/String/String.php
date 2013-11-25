<?php

namespace ValueObjects\String;

use ValueObjects\ValueObject;

class String extends ValueObject
{
    private $value;

    public function __construct($value)
    {
        $this->value = strval($value);
    }

    /**
     * Returns the value of the string
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Tells whether two strings are equal by comparing their values
     *
     * @param ValueObject $string
     * @return bool
     */
    public function equals(ValueObject $string)
    {
        if(false === parent::equals($string)) {
            return false;
        }

        return $this->getValue() === $string->getValue();
    }

    /**
     * Returns the string value itself
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getValue();
    }
}