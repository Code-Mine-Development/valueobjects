<?php

namespace ValueObjects\Number;

interface NumberInterface
{
    /**
     * Returns a PHP native implementation of the Number value
     *
     * @return mixed
     */
    public function toNative();

    public function add(NumberInterface $number);

    public function subtract(NumberInterface $number);

    public function multiply(NumberInterface $number);

    public function divide(NumberInterface $number);

    public function toPower(NumberInterface $number);

    public function square();

    public function squareRoot();

    public function cube();

    public function isEven();

    public function isOdd();

    public function isGreaterThan(NumberInterface $number);

    public function isGreaterOrEqual(NumberInterface $number);

    public function isLessThan(NumberInterface $number);

    public function isLessOrEqual(NumberInterface $number);

    public function modulo(NumberInterface $number);

    public function isZero();

    public function isPositive();

    public function isNegative();
}
