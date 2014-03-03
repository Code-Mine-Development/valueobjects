<?php

namespace ValueObjects\String;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

class String implements ValueObjectInterface
{
    protected $value;

    /**
     * Returns a String object given a PHP native string as parameter.
     *
     * @param  string $value
     * @return String
     */
    public static function fromNative()
    {
        $value = func_get_arg(0);

        return new static($value);
    }

    /**
     * Returns a String object given a PHP native string as parameter.
     *
     * @param string $value
     */
    public function __construct($value)
    {
        if (false === \is_string($value)) {
            throw new InvalidNativeArgumentException($value, array('string'));
        }

        $this->value = $value;
    }

    /**
     * Returns the value of the string
     *
     * @return string
     */
    public function toNative()
    {
        return $this->value;
    }

    /**
     * Tells whether two strings are equal by comparing their values
     *
     * @param  ValueObjectInterface $string
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $string)
    {
        if (false === Util::classEquals($this, $string)) {
            return false;
        }

        return $this->toNative() === $string->toNative();
    }

    /**
     * Tells whether the String is empty
     *
     * @return bool
     */
    public function isEmpty()
    {
        return \strlen($this->toNative()) == 0;
    }

    /**
     * Returns the string value itself
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toNative();
    }
}
