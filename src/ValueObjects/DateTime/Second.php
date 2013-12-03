<?php

namespace ValueObjects\DateTime;

use ValueObjects\DateTime\Exception\InvalidSecondException;
use ValueObjects\Number\Integer;

class Second extends Integer
{
    const MIN_SECOND = 0;
    const MAX_SECOND = 59;

    public function __construct($value)
    {
        if ($value < self::MIN_SECOND || $value > self::MAX_SECOND) {
            throw new InvalidSecondException($value);
        }

        parent::__construct($value);
    }

    /**
     * Returns the current second.
     *
     * @return Second
     */
    public static function now()
    {
        $now    = new \DateTime('now');
        $second = $now->format('s');

        return new self($second);
    }
}
