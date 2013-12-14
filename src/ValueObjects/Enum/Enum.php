<?php

namespace ValueObjects\Enum;

use MabeEnum\Enum as BaseEnum;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

class Enum extends BaseEnum implements ValueObjectInterface
{
    public function equals(ValueObjectInterface $enum)
    {
        if (false === Util::classEquals($this, $enum)) {
            return false;
        }

        return $this->getValue() === $enum->getValue();
    }

    public function __toString()
    {
        return \strval($this->getValue());
    }
}
