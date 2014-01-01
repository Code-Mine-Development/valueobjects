<?php

namespace ValueObjects\Geography;

use ValueObjects\String\String;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

class Street implements ValueObjectInterface
{
    /** @var String */
    protected $name;

    /** @var String */
    protected $number;

    /**
     * Returns a new Street from native PHP string name and number.
     *
     * @param  string                    $name
     * @param  string                    $number
     * @return Street
     * @throws \BadFunctionCallException
     */
    public static function fromNative()
    {
        $args = func_get_args();

        if (\count($args) != 2) {
            throw new \BadMethodCallException('You must provide exactly 2 arguments: 1) street name, 2) street number.');
        }

        $nameString   = $args[0];
        $numberString = $args[1];

        $name   = new String($nameString);
        $number = new String($numberString);

        return new self($name, $number);
    }

    /**
     * Returns a new Street object
     *
     * @param String $name
     * @param String $number
     */
    public function __construct(String $name, String $number)
    {
        $this->name   = $name;
        $this->number = $number;
    }

    /**
     * Tells whether two Street objects are equal
     * @param  ValueObjectInterface $street
     * @return bool
     */
    public function equals(ValueObjectInterface $street)
    {
        if (false === Util::classEquals($this, $street)) {
            return false;
        }

        return $this->getName()->equals($street->getName()) && $this->getNumber()->equals($street->getNumber());
    }

    /**
     * Returns street name
     *
     * @return String
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns street number
     *
     * @return String
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Returns a string representation of the String in the format "$number $name"
     *
     * @return string
     */
    public function __toString()
    {
        $streetString = \sprintf('%s %s', $this->getNumber(), $this->getName());

        return $streetString;
    }
}
