<?php

namespace App;

use App\Interfaces\Command;

class MacroCommand implements Command
{
    /** @var Command[] $commands */
    private array $commands;

    /**
     * @param Command[] $commands
     * @return void
     */
    public function __construct(array $commands)
    {
        $this->commands = $commands;
    }

    public function execute(): void
    {
        foreach ($this->commands as $command) {
            $command->execute();
        }
    }
}
