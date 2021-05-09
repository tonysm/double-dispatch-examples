<?php

class Integer
{
    public function __construct(public int $value)
    {
    }

    public function add(Integer $number): Integer
    {
        return new Integer($this->value + $number->value);
    }
}

class FloatNumber
{
    public function __construct(public float $value)
    {
    }

    public function add(FloatNumber $number): FloatNumber
    {
        return new FloatNumber($this->value + $number->value);
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
