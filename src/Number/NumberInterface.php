<?php

namespace ValueObjects\Number;

use ValueObjects\ValueObjectInterface;

interface NumberInterface extends ValueObjectInterface
{
    /**
     * Returns a PHP native implementation of the Number value
     *
     * @return NumberInterface
     */
    public function toNative();


    
}
