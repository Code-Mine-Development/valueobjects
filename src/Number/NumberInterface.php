<?php

namespace ValueObjects\Number;

interface NumberInterface
{
    /**
     * Returns a PHP native implementation of the Number value
     *
     * @return NumberInterface
     */
    public function toNative();


    /**
     * @param \ValueObjects\Number\NumberInterface $number
     *
     * @return NumberInterface
     */
    public function add(NumberInterface $number);

    /**
     * @param \ValueObjects\Number\NumberInterface $number
     *
     * @return NumberInterface
     */
    public function subtract(NumberInterface $number);

    /**
     * @param \ValueObjects\Number\NumberInterface $number
     *
     * @return NumberInterface
     */
    public function multiply(NumberInterface $number);

    /**
     * @param \ValueObjects\Number\NumberInterface $number
     *
     * @return NumberInterface
     */
    public function divide(NumberInterface $number);

    /**
     * @param \ValueObjects\Number\NumberInterface $number
     *
     * @return NumberInterface
     */
    public function toPower(NumberInterface $number);

    /**
     * @return NumberInterface
     */
    public function square();

    /**
     * @return NumberInterface
     */
    public function squareRoot();

    /**
     * @param \ValueObjects\Number\NumberInterface $number
     *
     * @return NumberInterface
     */
    public function root(NumberInterface $number);

    /**
     * @return NumberInterface
     */
    public function cube();

    /**
     * @return NumberInterface
     */
    public function isEven();

    /**
     * @return NumberInterface
     */
    public function isOdd();

    /**
     * @return NumberInterface
     */
    public function factorial();

    /**
     * @param \ValueObjects\Number\NumberInterface $number
     *
     * @return NumberInterface
     */
    public function isGreaterThan(NumberInterface $number);

    /**
     * @param \ValueObjects\Number\NumberInterface $number
     *
     * @return NumberInterface
     */
    public function isGreaterOrEqual(NumberInterface $number);

    /**
     * @param \ValueObjects\Number\NumberInterface $number
     *
     * @return NumberInterface
     */
    public function isLessThan(NumberInterface $number);

    /**
     * @param \ValueObjects\Number\NumberInterface $number
     *
     * @return NumberInterface
     */
    public function isLessOrEqual(NumberInterface $number);

    /**
     * @param \ValueObjects\Number\NumberInterface $number
     *
     * @return NumberInterface
     */
    public function modulo(NumberInterface $number);

    /**
     * @return NumberInterface
     */
    public function isZero();

    /**
     * @return NumberInterface
     */
    public function isPositive();

    /**
     * @return NumberInterface
     */
    public function isNegative();

    /**
     * @return NumberInterface
     */
    public function digits();
}
