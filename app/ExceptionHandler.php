<?php

namespace App;

use App\Exceptions\CommandException;
use App\Interfaces\Command;
use App\Interfaces\ExceptionHandlerInterface;
use Exception;

class ExceptionHandler implements ExceptionHandlerInterface
{
    private array $dictionary = [];

    public function handle(Command $command, Exception $exception): void
    {
        $exceptionHandler = $this->getHandler($command, $exception);
        if (empty($exceptionHandler)) {
            throw new CommandException('Обработчик исключения не найден');
        }

        $exceptionHandler->execute();
    }

    private function getHandler(Command $command, Exception $exception): ?Command
    {
        $commandExceptions = $this->dictionary[$command::class];
        return !empty($commandExceptions) ? $commandExceptions[$exception::class] : null;
    }
}
