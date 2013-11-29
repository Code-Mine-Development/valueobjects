<?php

namespace ValueObjects\Person;

use ValueObjects\Number\Integer;
use ValueObjects\Person\Exception\InvalidAgeException;

class Age extends Integer
{
    protected $value;

    public function __construct($value)
    {
        if ($value < 0) {
            throw new InvalidAgeException($value);
        }

        $this->value = intval($value);
    }
}
