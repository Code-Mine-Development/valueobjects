<?php

namespace ValueObjects\DateTime;

use ValueObjects\DateTime\Exception\DateTimeException;
use ValueObjects\DateTime\Exception\InvalidDateTimeException;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

class DateTime implements ValueObjectInterface
{
    /** @var Date */
    protected $date;

    /** @var Time */
    protected $time;

    /**
     * Returns a new DateTime from a native PHP \DateTime
     *
     * @param  \DateTime $date_time
     * @return DateTime
     */
    public static function fromNativeDateTime(\DateTime $date_time)
    {
        $year   = $date_time->format('Y');
        $month  = $date_time->format('n');
        $day    = $date_time->format('j');
        $hour   = $date_time->format('G');
        $minute = $date_time->format('i');
        $second = $date_time->format('s');

        return new self($year, $month, $day, $hour, $minute, $second);
    }

    /**
     * Returns current DateTime
     *
     * @return DateTime
     */
    public static function now()
    {
        $dateTime = new self(Year::now()->getValue(), Month::now()->getValue(), MonthDay::now()->getValue(), Hour::now()->getValue(), Minute::now()->getValue(), Second::now()->getValue());

        return $dateTime;
    }

    public function __construct($year, $month, $day, $hour = 0, $minute = 0, $second = 0)
    {
        try {
            $this->date = new Date($year, $month, $day);
            $this->time = new Time($hour, $minute, $second);
        } catch (DateTimeException $e) {
            throw new InvalidDateTimeException($year, $month, $day, $hour, $minute, $second);
        }
    }

    /**
     * Tells whether two DateTime are equal by comparing their values
     *
     * @param  ValueObjectInterface $date_time
     * @return bool
     */
    public function equals(ValueObjectInterface $date_time)
    {
        if (false === Util::classEquals($this, $date_time)) {
            return false;
        }

        return $this->getDate()->equals($date_time->getDate()) && $this->getTime()->equals($date_time->getTime());
    }

    /**
     * Returns date from current DateTime
     *
     * @return Time
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Returns time from current DateTime
     *
     * @return Time
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Returns a native PHP \DateTime version of the current DateTime.
     *
     * @return \DateTime
     */
    public function toNativeDateTime()
    {
        $year   = $this->getDate()->getYear()->getValue();
        $month  = $this->getDate()->getMonth()->getValue();
        $day    = $this->getDate()->getDay()->getValue();
        $hour   = $this->getTime()->getHour()->getValue();
        $minute = $this->getTime()->getMinute()->getValue();
        $second = $this->getTime()->getSecond()->getValue();

        $dateTime = new \DateTime();
        $dateTime->setDate($year, $month, $day);
        $dateTime->setTime($hour, $minute, $second);

        return $dateTime;
    }

    /**
     * Returns DateTime as string in format "Y-n-j G:i:s"
     *
     * @return string
     */
    public function __toString()
    {
        return \sprintf('%s %s', $this->getDate(), $this->getTime());
    }
}
