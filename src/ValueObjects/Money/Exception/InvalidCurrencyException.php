<?php

namespace ValueObjects\Money\Exception;

class InvalidCurrencyException extends \InvalidArgumentException
{
    public function __construct($name)
    {
        parent::__construct(sprintf('"%s" is not a valid currency name.', $name));
    }
}
