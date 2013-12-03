<?php

namespace ValueObjects;

interface ValueObjectInterface
{
    /**
     * Compare two ValueObjectInterface and tells whether they can be considered equal
     *
     * @param  ValueObjectInterface $object
     * @return bool
     */
    public function equals(ValueObjectInterface $object);

    /**
     * @return string
     */
    public function __toString();
}
