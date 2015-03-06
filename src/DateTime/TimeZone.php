<?php

namespace ValueObjects\DateTime;

use ValueObjects\DateTime\Exception\InvalidTimeZoneException;
use ValueObjects\String\String;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

class TimeZone implements ValueObjectInterface
{
    /** @var String */
    protected $name;

    /**
     * Returns a new Time object from native timezone name
     *
     * @param  string $name
     * @return self
     */
    public static function fromNative()
    {
        $args = func_get_args();

        $name = new String($args[0]);

        return new static($name);
    }

    /**
     * Returns a new Time from a native PHP \DateTime
     *
     * @param  \DateTimeZone $timezone
     * @return self
     */
    public static function fromNativeDateTimeZone(\DateTimeZone $timezone)
    {
        return static::fromNative($timezone->getName());
    }

    /**
     * Returns default TimeZone
     *
     * @return self
     */
    public static function fromDefault()
    {
        return new static(new String(date_default_timezone_get()));
    }

    /**
     * Returns a new TimeZone object
     *
     * @parm String $name
     */
    public function __construct(String $name)
    {
        if (!in_array($name->toNative(), timezone_identifiers_list())) {
            throw new InvalidTimeZoneException($name);
        }

        $this->name = $name;
    }

    /**
     * Returns a native PHP \DateTimeZone version of the current TimeZone.
     *
     * @return \DateTimeZone
     */
    public function toNativeDateTimeZone()
    {
        return new \DateTimeZone($this->getName()->toNative());
    }

    /**
     * Tells whether two DateTimeZone are equal by comparing their names
     *
     * @param  ValueObjectInterface $timezone
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $timezone)
    {
        if (false === Util::classEquals($this, $timezone)) {
            return false;
        }

        return $this->getName()->sameValueAs($timezone->getName());
    }

    /**
     * Returns timezone name
     *
     * @return String
     */
    public function getName()
    {
        return clone $this->name;
    }

    /**
     * Returns timezone name as string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getName()->__toString();
    }
}
