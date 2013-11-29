<?php

namespace ValueObjects\Person\Exception;

class InvalidSexException extends \InvalidArgumentException
{
    public function __construct($value, $accepted_values)
    {
        parent::__construct(sprintf('Sex value "%s" is not valid. Accetped values are %s.', $value, implode(', ', $accepted_values)));
    }
}
