<?php

namespace ValueObjects\Person;

use ValueObjects\Person\Exception\InvalidSexException;
use ValueObjects\ValueObject;

class Sex extends ValueObject
{
    const MALE   = 'male';
    const FEMALE = 'female';
    const OTHER  = 'other';

    protected $value;

    public function __construct($value)
    {
        $ref = new \ReflectionClass($this);
        $values = $ref->getConstants();
        if (false === in_array($value, $values)) {
            throw new InvalidSexException($value, $values);
        }

        $this->value = strval($value);
    }

    /**
     * Returns the value of the Sex object
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Tells whether two Sex objects are equal by comparing their values
     *
     * @param  ValueObject $sex
     * @return bool
     */
    public function equals(ValueObject $sex)
    {
        if (false === parent::equals($sex)) {
            return false;
        }

        return $this->getValue() === $sex->getValue();
    }

    /**
     * Returns the Sex value
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getValue();
    }
}
