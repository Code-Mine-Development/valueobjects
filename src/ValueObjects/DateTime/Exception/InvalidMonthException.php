<?php

namespace ValueObjects\DateTime\Exception;

class InvalidMonthException extends DateTimeException
{
    public function __construct($value)
    {
        $message = sprintf('The value "%d" is invalid. Please use an integer between 1 and 12.', $value);
        parent::__construct($message);
    }
}
