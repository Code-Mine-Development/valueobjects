<?php

namespace ValueObjects\Number;

use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

class Complex implements ValueObjectInterface, NumberInterface
{
    /** @var Real */
    protected $real;

    /** @var Real */
    protected $im;

    /**
     * Returns a new Complex object from native PHP arguments
     *
     * @param  float                        $real Real part of the complex number
     * @param  float                        $im   Imaginary part of the complex number
     * @return Complex|ValueObjectInterface
     * @throws \BadMethodCallException
     */
    public static function fromNative()
    {
        $args = \func_get_args();

        if (\count($args) != 2) {
            throw new \BadMethodCallException('You must provide 2 arguments: 1) real part, 2) imaginary part');
        }

        $real    = Real::fromNative($args[0]);
        $im      = Real::fromNative($args[1]);
        $complex = new self($real, $im);

        return $complex;
    }

    /**
     * Returns a Complex given polar coordinates
     *
     * @param  Real    $modulus
     * @param  Real    $argument
     * @return Complex
     */
    public static function fromPolar(Real $modulus, Real $argument)
    {
        $realValue = $modulus->getValue() * \cos($argument->getValue());
        $imValue   = $modulus->getValue() * \sin($argument->getValue());
        $real      = new Real($realValue);
        $im        = new Real($imValue);
        $complex   = new self($real, $im);

        return $complex;
    }

    /**
     * Returns a Complex object give its real and imaginary parts as parameters
     *
     * @param Real $real
     * @param Real $im
     */
    public function __construct(Real $real, Real $im)
    {
        $this->real = $real;
        $this->im   = $im;
    }

    public function equals(ValueObjectInterface $complex)
    {
        if (false === Util::classEquals($this, $complex)) {
            return false;
        }

        return $this->getReal()->equals($complex->getReal()) &&
               $this->getIm()->equals($complex->getIm());
    }

    /**
     * Returns the native value of the real and imaginary parts as an array
     *
     * @return array
     */
    public function getValue()
    {
        return array(
            $this->getReal()->getValue(),
            $this->getIm()->getValue()
        );
    }

    /**
     * Returns the real part of the complex number
     *
     * @return Real
     */
    public function getReal()
    {
        return $this->real;
    }

    /**
     * Returns the imaginary part of the complex number
     *
     * @return Real
     */
    public function getIm()
    {
        return $this->im;
    }

    /**
     * Returns the modulus (or absolute value or magnitude) of the Complex number
     *
     * @return Real
     */
    public function getModulus()
    {
        $real = $this->getReal()->getValue();
        $im   = $this->getIm()->getValue();
        $mod  = \sqrt(\pow($real, 2) + \pow($im, 2));

        return new Real($mod);
    }

    /**
     * Returns the argument (or phase) of the Complex number
     *
     * @return Real
     */
    public function getArgument()
    {
        $real = $this->getReal()->getValue();
        $im   = $this->getIm()->getValue();
        $arg  = \atan2($im, $real);

        return new Real($arg);
    }

    /**
     * Returns a native string version of the Complex object in format "${real} +|- ${complex}i"
     *
     * @return string
     */
    public function __toString()
    {
        $format = '%g %+gi';
        $real   = $this->getReal()->getValue();
        $im     = $this->getIm()->getValue();
        $string = \sprintf($format, $real, $im);

        return \preg_replace('/(\+|-)/', '$1 ', $string);
    }
}
