<?php

declare(strict_types = 1);

class Integer
{
    public function __construct(public int $value)
    {
    }

    public function add($number)
    {
        return $number->addInteger($this);
    }

    public function addInteger(Integer $number)
    {
        return new Integer($this->value + $number->value);
    }

    public function addFloat(FloatNumber $number)
    {
        return $number->addFloat($this->asFloat());
    }

    public function asFloat()
    {
        return new FloatNumber(floatval($this->value));
    }
}

class FloatNumber
{
    public function __construct(public float $value)
    {
    }

    public function add($number)
    {
        return $number->addFloat($this);
    }

    public function addFloat(FloatNumber $number)
    {
        return new FloatNumber($this->value + $number->value);
    }

    public function addInteger(Integer $number)
    {
        return $number->addInteger($this->asInteger());
    }

    public function asInteger()
    {
        return new Integer(intval($this->value));
    }
}

test('Integers can add other Integers', function () {
    $first = new Integer(10);
    $second = new Integer(5);

    $this->assertSame(15, $first->add($second)->value);
});

test('Floats can add other Floats', function () {
    $first = new FloatNumber(10.0);
    $second = new FloatNumber(5.0);

    $this->assertSame(15.0, $first->add($second)->value);
});

test('Can add Integers and Floats', function () {
    $first = new Integer(10);
    $second = new FloatNumber(5.0);

    $this->assertSame(15, $first->add($second)->value);
    $this->assertSame(15.0, $second->add($first)->value);
});
