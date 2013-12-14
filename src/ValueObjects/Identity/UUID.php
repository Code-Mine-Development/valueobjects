<?php

namespace ValueObjects\Identity;

use ValueObjects\String\String;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;
use Rhumsaa\Uuid\Uuid as BaseUuid;

class UUID extends String
{
    /** @var BaseUuid */
    protected $value;

    /**
     * @throws \LogicException
     */
    public static function fromNative()
    {
        throw new \LogicException('UUID objects must be directly created via constructor.');
    }

    public function __construct()
    {
        $this->value = \strval(BaseUuid::uuid4());
    }

    /**
     * Tells whether two UUID are equal by comapring their values
     *
     * @param  UUID $uuid
     * @return bool
     */
    public function equals(ValueObjectInterface $uuid)
    {
        if (false === Util::classEquals($this, $uuid)) {
            return false;
        }

        return $this->getValue() === $uuid->getValue();
    }
}
