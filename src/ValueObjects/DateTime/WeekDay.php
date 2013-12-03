<?php

namespace ValueObjects\DateTime;

use ValueObjects\DateTime\Exception\InvalidWeekDayException;
use ValueObjects\Number\Integer;

class WeekDay extends Integer
{
    const MONDAY    = 1;
    const TUESDAY   = 2;
    const WEDNESDAY = 3;
    const THURSDAY  = 4;
    const FRIDAY    = 5;
    const SATURDAY  = 6;
    const SUNDAY    = 7;

    public function __construct($value)
    {
        if($value < self::MONDAY || $value > self::SUNDAY) {
            throw new InvalidWeekDayException($value);
        }

        parent::__construct($value);
    }

    /**
     * Returns the current week day.
     *
     * @return WeekDay
     */
    public static function now()
    {
        $now     = new \DateTime('now');
        $weekDay = $now->format('N');

        return new self($weekDay);
    }
}