<?php

namespace ValueObjects\Identity;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\String\String;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;
use Rhumsaa\Uuid\Uuid as BaseUuid;

class UUID extends String
{
    /** @var BaseUuid */
    protected $value;

    /**
     * @param string $uuid
     * @return UUID
     * @throws \ValueObjects\Exception\InvalidNativeArgumentException
     */
    public static function fromNative()
    {
        $uuid = func_get_arg(0);

        try {

            $uuid = BaseUuid::fromString($uuid);

            $self = new static();

            $self->value = \strval($uuid);

            return $self;

        } catch (\InvalidArgumentException $ex) {
            throw new InvalidNativeArgumentException($uuid, array('UUID'));
        }
    }

    public function __construct()
    {
        $this->value = \strval(BaseUuid::uuid4());
    }

    /**
     * Tells whether two UUID are equal by comparing their values
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
