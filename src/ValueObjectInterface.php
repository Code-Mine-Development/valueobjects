<?php

namespace NicoloPigna\ValueObjects;

interface ValueObjectInterface
{
    /**
     * @param ValueObject $object
     * @return bool
     */
    public function equals(ValueObject $object);

    /**
     * @return string
     */
    public function __toString();
}