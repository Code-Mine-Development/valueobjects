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

    /** @var String Building, floor and unit */
    protected $elements;

    /**
     * @var String __toString() format
     * Use properties corresponding placeholders: %name%, %number%, %elements%
     */
    protected $format;

    /**
     * Returns a new Street from native PHP string name and number.
     *
     * @param string $name
     * @param string $number
     * @param string $elements
     * @return Street
     * @throws \BadFunctionCallException
     */
    public static function fromNative()
    {
        $args = func_get_args();

        if (\count($args) < 2) {
            throw new \BadMethodCallException('You must provide from 2 to 4 arguments: 1) street name, 2) street number, 3) elements, 4) format (optional)');
        }

        $nameString     = $args[0];
        $numberString   = $args[1];
        $elementsString = isset($args[2]) ? $args[2] : null;
        $formatString   = isset($args[3]) ? $args[3] : null;

        $name     = new String($nameString);
        $number   = new String($numberString);
        $elements = $elementsString ? new String($elementsString) : null;
        $format   = $formatString ? new String($formatString) : null;

        return new self($name, $number, $elements, $format);
    }

    /**
     * Returns a new Street object
     *
     * @param String $name
     * @param String $number
     */
    public function __construct(String $name, String $number, String $elements = null, String $format = null)
    {
        $this->name     = $name;
        $this->number   = $number;

        if ($elements === null) {
            $elements = new String('');
        }
        $this->elements = $elements;

        if ($format === null) {
            $format = new String('%number% %name%');
        }
        $this->format   = $format;
    }

    /**
     * Tells whether two Street objects are equal
     * @param  ValueObjectInterface $street
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $street)
    {
        if (false === Util::classEquals($this, $street)) {
            return false;
        }

        return $this->getName()->sameValueAs($street->getName()) &&
               $this->getNumber()->sameValueAs($street->getNumber()) &&
               $this->getElements()->sameValueAs($street->getElements());
        ;
    }

    /**
     * Returns street name
     *
     * @return String
     */
    public function getName()
    {
        return clone $this->name;
    }

    /**
     * Returns street number
     *
     * @return String
     */
    public function getNumber()
    {
        return clone $this->number;
    }

    /**
     * Returns street elements
     * @return String
     */
    public function getElements()
    {
        return clone $this->elements;
    }

    /**
     * Returns a string representation of the String in the format defined in the constructor
     *
     * @return string
     */
    public function __toString()
    {
        $replacements = array(
            "%name%"     => $this->getName(),
            "%number%"   => $this->getNumber(),
            "%elements%" => $this->getElements()
        );

        $streetString = str_replace(array_keys($replacements), array_values($replacements), $this->format);

        return $streetString;
    }
}
