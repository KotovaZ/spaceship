<?php

namespace App\Controllers;

use App\Exceptions\NotFoundException;
use App\Interfaces\Command;
use App\Interfaces\Controller;
use App\Interfaces\IncommingMessage;
use App\Interfaces\SenderInterface;
use App\IoC\IoC;

class ProcessIncomingMessage implements Controller
{
    public function handle(IncommingMessage $message): void
    {
        $gameId = $message->getGameId();

        /** @var SenderInterface $gameSender */
        $gameSender = IoC::resolve(
            'Game.Get',
            $gameId
        );
        
        $object = IoC::resolve(
            "Game.$gameId.Objects.Get",
            $message->getObjectId()
        );

        /** @var Command $command */
        $command = IoC::resolve(
            "Command.Factory.Get",
            $message->getCommandCode(),
            $object
        );

        $gameSender->send($command);
    }
}
