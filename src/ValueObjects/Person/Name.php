<?php

namespace ValueObjects\Person;

use ValueObjects\String\String;
use ValueObjects\ValueObject;

class Name extends ValueObject
{
    /**
     * First name
     *
     * @var \ValueObjects\String\String
     */
    private $firstName;

    /**
     * Middle name
     *
     * @var \ValueObjects\String\String
     */
    private $middleName;

    /**
     * Last name
     *
     * @var \ValueObjects\String\String
     */
    private $lastName;

    /**
     * @param string $first_name
     * @param string $middle_name
     * @param string $last_name
     */
    public function __construct($first_name, $middle_name, $last_name)
    {
        $this->firstName  = new String($first_name);
        $this->middleName = new String($middle_name);
        $this->lastName   = new String($last_name);
    }

    /**
     * Returns the first name
     *
     * @return String
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Returns the middle name
     *
     * @return String
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }

    /**
     * Returns the last name
     *
     * @return String
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Returns the full name
     *
     * @return String
     */
    public function getFullName()
    {
        $fullName = new String($this->firstName . ' ' . $this->middleName . ' ' . $this->lastName);

        return $fullName;
    }

    /**
     * Tells whether two names are equal by comparing their values
     *
     * @param  ValueObject $name
     * @return bool
     */
    public function equals(ValueObject $name)
    {
        if (false === parent::equals($name)) {
            return false;
        }

        return $this->getFullName() == $name->getFullName();
    }

    /**
     * Returns the full name
     *
     * @return string
     */
    public function __toString()
    {
        return strval($this->getFullName());
    }
}
