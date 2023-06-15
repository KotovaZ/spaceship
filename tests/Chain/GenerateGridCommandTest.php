<?php

require_once $_SERVER['DOCUMENT_ROOT'] . 'vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'app/Bootstrap.php';

use App\Field\GenerateGridCommand;
use App\Interfaces\Command;
use App\Interfaces\SenderInterface;
use App\IoC\IoC;
use App\Move\Movable;
use App\Thread\Thread;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;


final class GenerateGridCommandTest extends TestCase
{
    const GAME_UID = '00000000-0000-0000-0000-000000000001';
    private SenderInterface $sender;
    private Thread $thread;

    public function testGridGenerate()
    {
        $gridKey = 'BASE';

        /** @var Movable&MockObject $movableMock */
        $movableMock = $this->createMock(Movable::class);
        $generateGridCommand = new GenerateGridCommand(self::GAME_UID, $gridKey);
        $generateGridCommand->execute();

        $cells = IoC::resolve('Game.' . self::GAME_UID . '.Storage.Grid.' . $gridKey);
        $this->assertEquals(48, count($cells));
    }

    protected function setUp(): void
    {
        /** @var Command&MockObject $command */
        $command = $this->createMock(Command::class);
        /** @var CommandQueueInterface $queue */
        $queue = IoC::resolve(
            'CommandQueue.Create',
            [$command],
            2
        );

        /** @var ReceiverInterface $receiver */
        $receiver = IoC::resolve(
            'Receiver.Create',
            $queue
        );

        /** @var SenderInterface $sender */
        $this->sender = IoC::resolve(
            'Sender.Create',
            $queue
        );

        /** @var Thread $thread */
        $this->thread = IoC::resolve(
            'Thread.Create',
            $receiver
        );

        IoC::resolve('Game.Register', self::GAME_UID, $this->sender);
    }
}
