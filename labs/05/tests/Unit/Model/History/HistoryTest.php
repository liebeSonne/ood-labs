<?php

namespace Tests\Unit\Model\History;

use App\Command\CommandInterface;
use App\Model\History\History;
use PHPUnit\Framework\TestCase;

class HistoryTest extends TestCase
{
    public function testCanUndo(): void
    {
        $command = $this->createMock(CommandInterface::class);

        $history = new History();

        $this->assertFalse($history->canUndo());

        $history->addAndExecuteCommand($command);

        $this->assertTrue($history->canUndo());
    }

    public function testCanRedo(): void
    {
        $command = $this->createMock(CommandInterface::class);

        $history = new History();

        $this->assertFalse($history->canRedo());

        $history->addAndExecuteCommand($command);

        $this->assertFalse($history->canRedo());
    }

    public function testUndo(): void
    {
        $command = $this->createMock(CommandInterface::class);

        $history = new History();
        $history->addAndExecuteCommand($command);

        $command->expects($this->once())->method('unexecute');

        $history->undo();
    }

    public function testRedo(): void
    {
        $command = $this->createMock(CommandInterface::class);

        $history = new History();
        $history->addAndExecuteCommand($command);
        $history->undo();

        $command->expects($this->once())->method('execute');

        $history->redo();
    }

    public function testAddAndExecuteCommand(): void
    {
        $command = $this->createMock(CommandInterface::class);

        $history = new History();

        $command->expects($this->once())->method('execute');

        $history->addAndExecuteCommand($command);
    }
}