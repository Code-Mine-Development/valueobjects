<?php

namespace ValueObjects\DateTime;

use ValueObjects\DateTime\Exception\InvalidMonthDayException;
use ValueObjects\Number\Integer;

class MonthDay extends Integer
{
    const MIN_MONTH_DAY = 1;
    const MAX_MONTH_DAY = 31;

    public function __construct($value)
    {
        if($value < self::MIN_MONTH_DAY || $value > self::MAX_MONTH_DAY) {
            throw new InvalidMonthDayException($value);
        }

        parent::__construct($value);
    }

    /**
     * Returns the current month day.
     *
     * @return MonthDay
     */
    public static function now()
    {
        $now      = new \DateTime('now');
        $monthDay = $now->format('j');

        return new self($monthDay);
    }
}