<?php

interface Number
{
    public function add(Number $number): Number;
    public function addInteger(Integer $number): Number;
    public function addFloat(FloatNumber $number): Number;
}

class Integer implements Number
{
    public function __construct(public int $value)
    {
    }

    public function add(Number $number): Number
    {
        return $number->addInteger($this);
    }

    public function addInteger(Integer $integer): Number
    {
        return new Integer($this->value + $integer->value);
    }

    public function addFloat(FloatNumber $number): Number
    {
        return $this->asFloat()->add($number);
    }

    private function asFloat()
    {
        return new FloatNumber(floatval($this->value));
    }
}

class FloatNumber implements Number
{
    public function __construct(public float $value)
    {
    }

    public function add(Number $number): Number
    {
        return $number->addFloat($this);
    }

    public function addFloat(FloatNumber $number): Number
    {
        return new FloatNumber($this->value + $number->value);
    }

    public function addInteger(Integer $number): Number
    {
        return $this->asInteger()->addInteger($number);
    }

    private function asInteger()
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

test('Integers can add Floats', function () {
    $first = new Integer(10);
    $second = new FloatNumber(5.0);

    $this->assertSame(15, $first->add($second)->value);
});

test('Floats can add Integers', function () {
    $first = new Integer(10);
    $second = new FloatNumber(5.0);

    $this->assertSame(15.0, $second->add($first)->value);
});
