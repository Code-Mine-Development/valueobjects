<?php

namespace ValueObjects\Person\Exception;

class InvalidAgeException extends \InvalidArgumentException
{
    public function __construct($value)
    {
        parent::__construct(sprintf('Age value cannot be less than zero. %d given.', $value));
    }
}
