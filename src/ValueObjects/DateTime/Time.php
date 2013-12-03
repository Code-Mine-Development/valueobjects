<?php

namespace ValueObjects\DateTime;

use ValueObjects\DateTime\Exception\DateTimeException;
use ValueObjects\DateTime\Exception\InvalidTimeException;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

class Time implements ValueObjectInterface
{
    /** @var Hour */
    protected $hour;

    /** @var Minute */
    protected $minute;

    /** @var Second */
    protected $second;

    /**
     * Returns a new Time from a native PHP \DateTime
     *
     * @param  \DateTime $time
     * @return Time
     */
    public static function fromNativeDateTime(\DateTime $time)
    {
        $hour   = $time->format('G');
        $minute = $time->format('i');
        $second = $time->format('s');

        return new self($hour, $minute, $second);
    }

    /**
     * Returns current Time
     *
     * @return Time
     */
    public static function now()
    {
        $time = new self(Hour::now()->getValue(), Minute::now()->getValue(), Second::now()->getValue());

        return $time;
    }

    public function __construct($hour, $minute, $second)
    {
        try {
            $this->hour   = new Hour($hour);
            $this->minute = new Minute($minute);
            $this->second = new Second($second);
        } catch (DateTimeException $e) {
            throw new InvalidTimeException($hour, $minute, $second);
        }
    }

    /**
     * Tells whether two Time are equal by comparing their values
     *
     * @param  ValueObjectInterface $time
     * @return bool
     */
    public function equals(ValueObjectInterface $time)
    {
        if (false === Util::classEquals($this, $time)) {
            return false;
        }

        return $this->getHour()->equals($time->getHour()) && $this->getMinute()->equals($time->getMinute()) && $this->getSecond()->equals($time->getSecond());
    }

    /**
     * Get hour
     *
     * @return Hour
     */
    public function getHour()
    {
        return $this->hour;
    }

    /**
     * Get minute
     *
     * @return Minute
     */
    public function getMinute()
    {
        return $this->minute;
    }

    /**
     * Get second
     *
     * @return Second
     */
    public function getSecond()
    {
        return $this->second;
    }

    /**
     * Returns a native PHP \DateTime version of the current Time.
     * Date is set to current.
     *
     * @return \DateTime
     */
    public function toNativeDateTime()
    {
        $hour   = $this->getHour()->getValue();
        $minute = $this->getMinute()->getValue();
        $second = $this->getSecond()->getValue();

        $time = new \DateTime('now');
        $time->setTime($hour, $minute, $second);

        return $time;
    }

    /**
     * Returns time as string in format G:i:s
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toNativeDateTime()->format('G:i:s');
    }
}
