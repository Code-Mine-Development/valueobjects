<?php

namespace ValueObjects\Number;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

class Integer extends Real
{
    /**
     * Returns a Integer object given a PHP native int as parameter.
     *
     * @param int $value
     */
    public function __construct($value)
    {
        $value = filter_var($value, FILTER_VALIDATE_INT);

        if (false === $value) {
            throw new InvalidNativeArgumentException($value, array('int'));
        }

        parent::__construct($value);
    }

    /**
     * Tells whether two Integer are equal by comparing their values
     *
     * @param  ValueObjectInterface $integer
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
     * Returns the value of the integer number
     *
     * @return int
     */
    public function getValue()
    {
        $value = parent::getValue();

        return \intval($value);
    }
}
