<?php
/**
 * Creator: adamgrabek
 * Date: 22.04.2016
 * Time: 14:28
 */

namespace ValueObjects\Number;


interface MathAwareInterface
{
    /**
     * @param \ValueObjects\Number\MathAwareInterface $number
     *
     * @return MathAwareInterface
     */
    public function add(MathAwareInterface $number);

    /**
     * @param \ValueObjects\Number\MathAwareInterface $number
     *
     * @return MathAwareInterface
     */
    public function subtract(MathAwareInterface $number);

    /**
     * @param \ValueObjects\Number\MathAwareInterface $number
     *
     * @return MathAwareInterface
     */
    public function multiply(MathAwareInterface $number);

    /**
     * @param \ValueObjects\Number\MathAwareInterface $number
     *
     * @return MathAwareInterface
     */
    public function divide(MathAwareInterface $number);

    /**
     * @param \ValueObjects\Number\MathAwareInterface $number
     *
     * @return MathAwareInterface
     */
    public function toPower(MathAwareInterface $number);

    /**
     * @return MathAwareInterface
     */
    public function square();

    /**
     * @return MathAwareInterface
     */
    public function squareRoot();

    /**
     * @return MathAwareInterface
     */
    public function cube();

    /**
     * @return bool
     */
    public function isEven();

    /**
     * @return bool
     */
    public function isOdd();

    /**
     * @return MathAwareInterface
     */
    public function factorial();

    /**
     * @param \ValueObjects\Number\MathAwareInterface $number
     *
     * @return bool
     */
    public function isGreaterThan(MathAwareInterface $number);

    /**
     * @param \ValueObjects\Number\MathAwareInterface $number
     *
     * @return bool
     */
    public function isGreaterOrEqual(MathAwareInterface $number);

    /**
     * @param \ValueObjects\Number\MathAwareInterface $number
     *
     * @return bool
     */
    public function isLessThan(MathAwareInterface $number);

    /**
     * @param \ValueObjects\Number\MathAwareInterface $number
     *
     * @return bool
     */
    public function isLessOrEqual(MathAwareInterface $number);

    /**
     * @param \ValueObjects\Number\MathAwareInterface $number
     *
     * @return MathAwareInterface
     */
    public function modulo(MathAwareInterface $number);

    /**
     * @return bool
     */
    public function isZero();

    /**
     * @return bool
     */
    public function isPositive();

    /**
     * @return bool
     */
    public function isNegative();

    /**
     * @return MathAwareInterface
     */
    public function digits();

    /**
     * @return MathAwareInterface
     */
    public function inverse();

    public function increment();

    public function decrement();

    public function by10();

    public function by100();

    public function scientific();

    public static function zero();

    public static function random($min = NULL, $max = NULL);

    public function absolute();
}