<?php

namespace ValueObjects\DateTime;

use ValueObjects\DateTime\Exception\InvalidHourException;
use ValueObjects\Number\Integer;

class Hour extends Integer
{
    const MIN_HOUR = 0;
    const MAX_HOUR = 23;

    public function __construct($value)
    {
        if($value < self::MIN_HOUR || $value > self::MAX_HOUR) {
            throw new InvalidHourException($value);
        }

        parent::__construct($value);
    }

    /**
     * Returns the current hour.
     *
     * @return Hour
     */
    public static function now()
    {
        $now     = new \DateTime('now');
        $hour = $now->format('G');

        return new self($hour);
    }
}