<?php

namespace ValueObjects\DateTime;

use ValueObjects\DateTime\Exception\InvalidMinuteException;
use ValueObjects\Number\Integer;

class Minute extends Integer
{
    const MIN_MINUTE = 0;
    const MAX_MINUTE = 59;

    public function __construct($value)
    {
        if($value < self::MIN_MINUTE || $value > self::MAX_MINUTE) {
            throw new InvalidMinuteException($value);
        }

        parent::__construct($value);
    }

    /**
     * Returns the current minute.
     *
     * @return Minute
     */
    public static function now()
    {
        $now    = new \DateTime('now');
        $minute = $now->format('i');

        return new self($minute);
    }
}