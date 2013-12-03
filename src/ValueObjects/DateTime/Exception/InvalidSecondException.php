<?php

namespace ValueObjects\DateTime\Exception;

class InvalidSecondException extends DateTimeException
{
    public function __construct($value)
    {
        $message = sprintf('The value "%d" is invalid. Please use an integer between 0 and 59.', $value);
        parent::__construct($message);
    }
}
