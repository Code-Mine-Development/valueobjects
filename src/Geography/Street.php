<?php

namespace ValueObjects\Geography;

use ValueObjects\StringLiteral\StringLiteral;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

class Street implements ValueObjectInterface
{
    /** @var StringLiteral */
    protected $name;

    /** @var StringLiteral */
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
     *
     * @return Street
     * @throws \BadFunctionCallException
     */
    public static function fromNative()
    {
        $args = func_get_args();

        if (\count($args) < 2) {
            throw new \BadMethodCallException('You must provide from 2 to 4 arguments: 1) street name, 2) street number, 3) elements, 4) format (optional)');
        }

        $nameString = $args[0];
        $numberString = $args[1];
        $elementsString = isset($args[2]) ? $args[2] : NULL;
        $formatString = isset($args[3]) ? $args[3] : NULL;

        $name = new StringLiteral($nameString);
        $number = new StringLiteral($numberString);
        $elements = $elementsString ? new StringLiteral($elementsString) : NULL;
        $format = $formatString ? new StringLiteral($formatString) : NULL;

        return new self($name, $number, $elements, $format);
    }

    /**
     * Returns a new Street object
     *
     * @param String $name
     * @param String $number
     */
    public function __construct(StringLiteral $name, StringLiteral $number, StringLiteral $elements = NULL, StringLiteral $format = NULL)
    {
        $this->name = $name;
        $this->number = $number;

        if ($elements === NULL) {
            $elements = new StringLiteral('');
        }
        $this->elements = $elements;

        if ($format === NULL) {
            $format = new StringLiteral('%number% %name%');
        }
        $this->format = $format;
    }

    /**
     * Tells whether two Street objects are equal
     *
     * @param  ValueObjectInterface $street
     *
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $street)
    {
        if (FALSE === Util::classEquals($this, $street)) {
            return FALSE;
        }

        return $this->getName()->sameValueAs($street->getName()) &&
        $this->getNumber()->sameValueAs($street->getNumber()) &&
        $this->getElements()->sameValueAs($street->getElements());;
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
     *
     * @return String
     */
    public function getElements()
    {
        return clone $this->elements;
    }

    /**
     * Returns a string representation of the StringLiteral in the format defined in the constructor
     *
     * @return string
     */
    public function __toString()
    {
        $replacements = [
            "%name%"     => $this->getName(),
            "%number%"   => $this->getNumber(),
            "%elements%" => $this->getElements(),
        ];

        $streetString = str_replace(array_keys($replacements), array_values($replacements), $this->format);

        return $streetString;
    }

    function jsonSerialize()
    {
        return [
            'parts'     => [
                'name'     => $this->getName(),
                'number'   => $this->getNumber(),
                'elements' => $this->getElements(),
            ],
            'formatted' => (string)$this,
        ];

    }


}
