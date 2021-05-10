<?php

interface Animal
{
    public function makeNoise(): string;
    public function makeNoiseWith(Animal $animal): string;
}

class Dog implements Animal
{
    public function makeNoise(): string
    {
        return "Bark";
    }

    public function makeNoiseWith(Animal $animal): string
    {
        return implode(' ', [$this->makeNoise(), $animal->makeNoise()]);
    }
}

class Cat implements Animal
{
    public function makeNoise(): string
    {
        return "Meow";
    }

    public function makeNoiseWith(Animal $animal): string
    {
        return implode(' ', [$this->makeNoise(), $animal->makeNoise()]);
    }
}

test('Dogs and Cats make noise', function () {
    $this->assertEquals('Bark', (new Dog)->makeNoise());
    $this->assertEquals('Meow', (new Cat)->makeNoise());
});

test('Dogs and Cats make noise together', function () {
    $this->assertEquals('Bark Meow', (new Dog())->makeNoiseWith(new Cat));
});
