<?php

namespace ValueObjects\Number;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\StringLiteral\StringLiteral;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

class Real implements NumberInterface, MathAwareInterface
{
    protected $value;

    /**
     * Returns a Real object given a PHP native float as parameter.
     *
     * @param  float $number
     *
     * @return static
     */
    public static function fromNative()
    {
        $value = func_get_arg(0);

        return new static($value);
    }

    /**
     * Returns a Real object given a PHP native float as parameter.
     *
     * @param float $number
     */
    public function __construct($value)
    {
        $value = \filter_var($value, FILTER_VALIDATE_FLOAT);

        if (FALSE === $value) {
            throw new InvalidNativeArgumentException($value, ['float']);
        }

        $this->value = $value;
    }

    /**
     * Returns the native value of the real number
     *
     * @return float
     */
    public function toNative()
    {
        return $this->value;
    }

    /**
     * Tells whether two Real are equal by comparing their values
     *
     * @param  ValueObjectInterface $real
     *
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $real)
    {
        if (FALSE === Util::classEquals($this, $real)) {
            return FALSE;
        }

        return $this->toNative() === $real->toNative();
    }

    /**
     * Returns the integer part of the Real number as a Integer
     *
     * @param  RoundingMode $rounding_mode Rounding mode of the conversion. Defaults to RoundingMode::HALF_UP.
     *
     * @return Integer
     */
    public function toInteger(RoundingMode $rounding_mode = NULL)
    {
        if (NULL === $rounding_mode) {
            $rounding_mode = RoundingMode::HALF_UP();
        }

        $value = $this->toNative();
        $integerValue = \round($value, 0, $rounding_mode->toNative());
        $integer = new Integer($integerValue);

        return $integer;
    }

    /**
     * Returns the absolute integer part of the Real number as a Natural
     *
     * @param  RoundingMode $rounding_mode Rounding mode of the conversion. Defaults to RoundingMode::HALF_UP.
     *
     * @return Natural
     */
    public function toNatural(RoundingMode $rounding_mode = NULL)
    {
        $integerValue = $this->toInteger($rounding_mode)->toNative();
        $naturalValue = \abs($integerValue);
        $natural = new Natural($naturalValue);

        return $natural;
    }

    /**
     * Returns the string representation of the real value
     *
     * @return string
     */
    public function __toString()
    {
        return \strval($this->toNative());
    }

    static public function pi()
    {
        return self::fromNative(M_PI);
    }

    /**
     * @param \ValueObjects\Number\MathAwareInterface $number
     *
     * @return MathAwareInterface
     */
    public function add(MathAwareInterface $number)
    {
        return new static(bcadd($this, $number, 5));
    }

    /**
     * @param \ValueObjects\Number\MathAwareInterface $number
     *
     * @return MathAwareInterface
     */
    public function subtract(MathAwareInterface $number)
    {
        return new static(bcsub($this, $number, 5));

    }

    /**
     * @param \ValueObjects\Number\MathAwareInterface $number
     *
     * @return MathAwareInterface
     */
    public function multiply(MathAwareInterface $number)
    {
        return new static(bcmul($this, $number, 5));

    }

    /**
     * @param \ValueObjects\Number\MathAwareInterface $number
     *
     * @return MathAwareInterface
     */
    public function divide(MathAwareInterface $number)
    {
        return new static(bcdiv($this, $number, 5));


    }

    /**
     * @param \ValueObjects\Number\MathAwareInterface $number
     *
     * @return MathAwareInterface
     */
    public function toPower(MathAwareInterface $number)
    {
        return new static(bcpow($this->toNative(), $number->toNative(), 5));

    }

    /**
     * @return MathAwareInterface
     */
    public function square()
    {
        return new static(bcpow($this->toNative(), 2, 5));
    }

    /**
     * @return MathAwareInterface
     */
    public function squareRoot()
    {
        return new static(bcsqrt($this, 5));
    }


    /**
     * @return MathAwareInterface
     */
    public function cube()
    {
        return new static(bcpow($this->toNative(), 3, 5));

    }

    /**
     * @return bool
     */
    public function isEven()
    {
        return "0" === bcmod($this, 2);
    }

    /**
     * @return bool
     */
    public function isOdd()
    {
        return (FALSE === $this->isEven());
    }

    /**
     * @return MathAwareInterface
     */
    public function factorial()
    {

        $number = $this->toNative();
        $factorial = 1;
        for ($index = 1; $index <= $number; $index++)
            $factorial = bcmul($factorial, $index);

        return new static($factorial);

    }

    /**
     * @param \ValueObjects\Number\MathAwareInterface $number
     *
     * @return bool
     */
    public function isGreaterThan(MathAwareInterface $number)
    {
        return 1 == bccomp($this, $number);
    }

    /**
     * @param \ValueObjects\Number\MathAwareInterface $number
     *
     * @return bool
     */
    public function isGreaterOrEqual(MathAwareInterface $number)
    {
        return 0 <= bccomp($this, $number);

    }

    /**
     * @param \ValueObjects\Number\MathAwareInterface $number
     *
     * @return bool
     */
    public function isLessThan(MathAwareInterface $number)
    {
        return -1 == bccomp($this, $number);

    }

    /**
     * @param \ValueObjects\Number\MathAwareInterface $number
     *
     * @return bool
     */
    public function isLessOrEqual(MathAwareInterface $number)
    {
        return 0 >= bccomp($this, $number);

    }

    /**
     * @param \ValueObjects\Number\MathAwareInterface $number
     *
     * @return MathAwareInterface
     */
    public function modulo(MathAwareInterface $number)
    {
        return new static(bcmod($this, $number));
    }

    /**
     * @return bool
     */
    public function isZero()
    {
        return 0 === bccomp($this, "0");
    }

    /**
     * @return bool
     */
    public function isPositive()
    {
        return 1 === bccomp($this, "0");

    }

    /**
     * @return bool
     */
    public function isNegative()
    {
        return -1 === bccomp($this, "0");
    }

    /**
     * @return MathAwareInterface
     */
    public function digits()
    {
        return new static(strlen($this));
    }

    /**
     * @return MathAwareInterface
     */
    public function inverse()
    {
        return $this->multiply(new Real(-1));

    }

    public function increment()
    {
        return $this->add(new Real(1));
    }

    public function decrement()
    {
        return $this->subtract(new Real(1));

    }

    public function by10()
    {
        return $this->divide(new Real(10));

    }

    public function by100()
    {
        return $this->divide(new Real(100));

    }

    /**
     * @return StringLiteral
     */
    public function scientific()
    {
        return new StringLiteral(sprintf('%e', $this->toNative()));
    }

    public static function zero()
    {
        return new static(0);
    }

    public static function random($min = NULL, $max = NULL)
    {
        return new static(mt_rand($min, $max));
    }

    public function absolute()
    {
        if($this->isNegative()) {
            return $this->inverse();
        }

        return $this;
    }


}
