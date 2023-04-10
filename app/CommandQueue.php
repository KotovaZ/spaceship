<?php

namespace App;

use App\Interfaces\Command;
use App\Interfaces\CommandQueueInterface;

class CommandQueue implements CommandQueueInterface
{
    private array $queue = [];

    /**
     * @param Command[] $queue
     * @return void
     */
    public function __construct(array $queue)
    {
        $this->queue = $queue;
    }

    public function take(): ?Command
    {
        return array_shift($queue);
    }

    public function push(Command $command): void
    {
        $queue[] = $command;
    }
}
