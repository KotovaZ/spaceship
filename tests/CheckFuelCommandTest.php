<?php

require_once $_SERVER['DOCUMENT_ROOT'] . 'vendor/autoload.php';

use App\Exceptions\CommandException;
use App\Fuel\CheckFuelCommand;
use App\Fuel\Fuelable;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class CheckFuelCommandTest extends TestCase
{
    public function testCheckFuel()
    {
        /** @var Fuelable&MockObject $mock */
        $mock = $this->createMock(Fuelable::class);
        $mock->method('getFuel')->willReturn(0);

        $command = new CheckFuelCommand($mock);
        $this->expectException(CommandException::class);
        $command->execute();
    }
}
