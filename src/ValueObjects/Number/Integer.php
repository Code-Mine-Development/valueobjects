<?php

namespace ValueObjects\Number;

use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

class Integer implements ValueObjectInterface
{
    protected $value;

    public function __construct($value)
    {
        $this->value = intval($value);
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
     * @param ValueObjectInterface $integer
     * @return bool
     */
    public function equals(ValueObjectInterface $integer)
    {
        if (false === Util::classEquals($this, $integer)) {
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
        return \strval($this->getValue());
    }
}
