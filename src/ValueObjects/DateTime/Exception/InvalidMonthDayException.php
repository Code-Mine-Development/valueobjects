<?php

namespace ValueObjects\DateTime\Exception;

class InvalidMonthDayException extends DateTimeException
{
    public function __construct($value)
    {
        $message = sprintf('The value "%d" is invalid. Please use an integer between 1 and 31.', $value);
        parent::__construct($message);
    }
}