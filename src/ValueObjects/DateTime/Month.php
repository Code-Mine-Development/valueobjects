<?php

namespace ValueObjects\DateTime;

use ValueObjects\DateTime\Exception\InvalidMonthException;
use ValueObjects\Number\Integer;

class Month extends Integer
{
    const JANUARY   = 1;
    const FEBRUARY  = 2;
    const MARCH     = 3;
    const APRIL     = 4;
    const MAY       = 5;
    const JUNE      = 6;
    const JULY      = 7;
    const AUGUST    = 8;
    const SEPTEMBER = 9;
    const OCTOBER   = 10;
    const NOVEMBER  = 11;
    const DECEMBER  = 12;

    public function __construct($value)
    {
        if ($value < self::JANUARY || $value > self::DECEMBER) {
            throw new InvalidMonthException($value);
        }

        parent::__construct($value);
    }

    /**
     * Returns the current month.
     *
     * @return Month
     */
    public static function now()
    {
        $now   = new \DateTime('now');
        $month = $now->format('n');

        return new self($month);
    }
}
