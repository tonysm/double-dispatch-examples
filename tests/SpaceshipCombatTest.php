<?php

class Shuttle
{
    public function __construct(public int $hitpoints)
    {
    }

    public function fight($enemy)
    {
        $enemy->fightShuttle($this);
    }
}

class UssVoyager
{
    public function __construct(public int $hitpoints)
    {
    }

    public function fight($enemy)
    {
        $enemy->fightUssVoyager($this);
    }
}

class Asteroid
{
    public function fightShuttle(Shuttle $shuttle)
    {
        $shuttle->hitpoints -= 10;
    }

    public function fightUssVoyager(UssVoyager $ussVoyager)
    {
        // Does nothing...
    }
}

class BorgCube
{
    public function fightShuttle(Shuttle $shuttle)
    {
        $shuttle->hitpoints = 0;
    }

    public function fightUssVoyager(UssVoyager $ussVoyager)
    {
        $ussVoyager->hitpoints = 0;
    }
}

test('asteroid damages shuttle', function () {
    $spaceship = new Shuttle(hitpoints: 100);
    $enemy = new Asteroid();

    $spaceship->fight($enemy);

    $this->assertEquals(90, $spaceship->hitpoints);
});

test('asteroid does not damage uss voyager', function () {
    $spaceship = new UssVoyager(hitpoints: $initialHitpoints = 100);
    $enemy = new Asteroid();

    $spaceship->fight($enemy);

    $this->assertSame($initialHitpoints, $spaceship->hitpoints);
});

test('borg cube critically damages the shuttle', function () {
    $spaceship = new Shuttle(hitpoints: 100);
    $enemy = new BorgCube();

    $spaceship->fight($enemy);

    $this->assertSame(0, $spaceship->hitpoints);
});

test('borg cube critically damages the uss voyager', function () {
    $spaceship = new UssVoyager(hitpoints: 100);
    $enemy = new BorgCube();

    $spaceship->fight($enemy);

    $this->assertSame(0, $spaceship->hitpoints);
});
