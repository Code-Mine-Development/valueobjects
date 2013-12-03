<?php

namespace ValueObjects\String;

use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

class String implements ValueObjectInterface
{
    protected $value;

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
     * @param  ValueObjectInterface $string
     * @return bool
     */
    public function equals(ValueObjectInterface $string)
    {
        if (false === Util::classEquals($this, $string)) {
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
