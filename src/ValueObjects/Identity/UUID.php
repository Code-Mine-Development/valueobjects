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

    public function __construct()
    {
        $this->value = \strval(BaseUuid::uuid4());
    }

    public function equals(ValueObjectInterface $uuid)
    {
        if (false === Util::classEquals($this, $uuid)) {
            return false;
        }

        return $this->getValue() === $uuid->getValue();
    }
}
