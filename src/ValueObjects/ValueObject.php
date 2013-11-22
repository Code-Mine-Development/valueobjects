<?php

namespace ValueObjects;

abstract class ValueObject implements ValueObjectInterface
{
    /**
     * Tells whether two objects are the same by comparing their classes.
     *
     * @param  ValueObject $object
     * @return bool
     */
    public function equals(ValueObject $object)
    {
        if (\get_class($object) !== \get_class($this)) {
            return false;
        }

        return true;
    }

    /**
     * Returns the fully namespaced class name.
     *
     * @return string
     */
    public function __toString()
    {
        return \get_class($this);
    }

}
