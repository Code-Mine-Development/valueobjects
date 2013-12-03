<?php

namespace ValueObjects\DateTime\Exception;

class InvalidDateTimeException extends DateTimeException
{
    public function __construct($year, $month, $day, $hour, $minute, $second)
    {
        $dateTime = \sprintf('%d-%d-%d %d:%d:%d', $year, $month, $day, $hour, $minute, $second);
        $message  = \sprintf('The date/time "%s" is invalid.', $dateTime);
        parent::__construct($message);
    }
}
