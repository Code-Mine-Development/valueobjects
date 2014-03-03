<?php

namespace ValueObjects\Null;

use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

class Null implements ValueObjectInterface
{
    /**
     * @throws \BadMethodCallException
     */
    public static function fromNative()
    {
        throw new \BadMethodCallException('Cannot create a Null object via this method.');
    }

    /**
     * Returns a new Null object
     *
     * @return static
     */
    public static function create()
    {
        return new static();
    }

    /**
     * Tells whether two objects are both Null
     * @param  ValueObjectInterface $null
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $null)
    {
        return Util::classEquals($this, $null);
    }

    /**
     * Returns a string representation of the Null object
     *
     * @return string
     */
    public function __toString()
    {
        return \strval(null);
    }
}
