<?php

namespace ValueObjects\DateTime\Exception;

class InvalidTimeException extends DateTimeException
{
    public function __construct($hour, $minute, $second)
    {
        $time    = \sprintf('%d:%d:%d', $hour, $minute, $second);
        $message = \sprintf('The time "%s" is invalid.', $time);
        parent::__construct($message);
    }
}