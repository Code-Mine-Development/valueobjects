<?php

namespace ValueObjects\DateTime;

use ValueObjects\DateTime\Exception\DateTimeException;
use ValueObjects\DateTime\Exception\InvalidDateException;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

class Date implements ValueObjectInterface
{
    /** @var Year */
    protected $year;

    /** @var Month */
    protected $month;

    /** @var MonthDay */
    protected $day;

    /**
     * Returns a new Date from a native PHP \DateTime
     *
     * @param \DateTime $date
     * @return Date
     */
    public static function fromNativeDateTime(\DateTime $date)
    {
        $year  = $date->format('Y');
        $month = $date->format('m');
        $day   = $date->format('d');

        return new self($year, $month, $day);
    }

    /**
     * Returns current Date
     *
     * @return Date
     */
    public static function now()
    {
        $now = new \DateTime('now');

        return self::fromNativeDateTime($now);
    }

    public function __construct($year, $month, $day)
    {
        try {
            \DateTime::createFromFormat('Y-n-j', \sprintf('%d-%d-%d', $year, $month, $day));
            $nativeDateErrors = \DateTime::getLastErrors();

            if($nativeDateErrors['warning_count'] > 0 || $nativeDateErrors['error_count'] > 0) {
                throw new DateTimeException();
            }

            $this->year  = new Year($year);
            $this->month = new Month($month);
            $this->day   = new MonthDay($day);
        } catch(DateTimeException $e) {
            throw new InvalidDateException($year, $month, $day);
        }
    }

    /**
     * Tells whether two Date are equal by comparing their values
     *
     * @param ValueObjectInterface $date
     * @return bool
     */
    public function equals(ValueObjectInterface $date)
    {
        if(false === Util::classEquals($this, $date)) {
            return false;
        }

        return $this->getYear()->equals($date->getYear()) && $this->getMonth()->equals($date->getMonth()) && $this->getDay()->equals($date->getDay());
    }

    /**
     * Get year
     *
     * @return Year
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Get month
     *
     * @return Month
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * Get day
     *
     * @return MonthDay
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Returns a native PHP \DateTime version of the current Date
     *
     * @return \DateTime
     */
    public function toNativeDateTime()
    {
        $year  = \intval($this->getYear()->getValue());
        $month = \intval($this->getMonth()->getValue());
        $day   = \intval($this->getDay()->getValue());

        $date = new \DateTime();
        $date->setDate($year, $month, $day);
        $date->setTime(0, 0, 0);

        return $date;
    }

    /**
     * Returns date as string in format Y-n-j
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toNativeDateTime()->format('Y-n-j');
    }
}