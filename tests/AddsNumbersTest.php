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

test('Integers can add other Integers', function () {
    $first = new Integer(10);
    $second = new Integer(5);

    $this->assertSame(15, $first->add($second)->value);
});
