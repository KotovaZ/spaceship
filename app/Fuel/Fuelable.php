<?php

namespace App\Fuel;

interface Fuelable
{
    public function getFuel(): int;
    public function addFuel(int $dfuel): void;
    public function getSpendVelocity(): int;
}
