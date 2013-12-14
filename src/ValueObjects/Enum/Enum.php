<?php

namespace ValueObjects\Enum;

use MabeEnum\Enum as BaseEnum;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

abstract class Enum extends BaseEnum implements ValueObjectInterface
{
    /**
     * Returns a new Enum object from passed value matching argument
     *
     * @param string $value
     * @return static
     */
    public static function fromNative()
    {
        return static::get(func_get_arg(0));
    }

    /**
     * Tells whether two Enum objects are equals by comparing their values
     *
     * @param Enum $enum
     * @return bool
     */
    public function equals(ValueObjectInterface $enum)
    {
        if (false === Util::classEquals($this, $enum)) {
            return false;
        }

        return $this->getValue() === $enum->getValue();
    }

    /**
     * Returns a native string representation of the Enum value
     *
     * @return string
     */
    public function __toString()
    {
        return \strval($this->getValue());
    }
}
