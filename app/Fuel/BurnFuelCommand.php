<?php

namespace App\Fuel;

use App\Fuel\Fuelable;
use App\Interfaces\Command;

class BurnFuelCommand implements Command
{
    private Fuelable $target;

    public function __construct(Fuelable $target)
    {
        $this->target = $target;
    }

    public function execute(): void
    {
        $newFuelAmount = $this->target->getFuel() - $this->target->getSpendVelocity();
        $this->target->setFuel($newFuelAmount);
    }
}
