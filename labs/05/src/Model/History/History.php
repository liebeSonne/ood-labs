<?php

namespace App\Model\History;

use App\Command\CommandInterface;

class History
{
    public const MAX_COMMANDS = 10;

    private int $nextCommandIndex = 0;

    /**
     * @var CommandInterface[]
     */
    private \Ds\Deque $commands;

    public function __construct()
    {
        $this->commands = new \Ds\Deque();
    }

    public function canUndo(): bool
    {
        return $this->nextCommandIndex !== 0;
    }

    public function canRedo(): bool
    {
        return $this->nextCommandIndex !== count($this->commands);
    }

    public function undo(): void
    {
        if ($this->canUndo()) {
            $this->commands[$this->nextCommandIndex - 1]->unexecute();
            --$this->nextCommandIndex;
        }
    }

    public function redo(): void
    {
        if ($this->canRedo()) {
            $this->commands[$this->nextCommandIndex]->execute();
            ++$this->nextCommandIndex;
        }
    }

    public function addAndExecuteCommand(CommandInterface $command): void
    {
        if ($this->nextCommandIndex < count($this->commands)) {
            $command->execute();
            $this->commands->set($this->nextCommandIndex, $command);
            ++$this->nextCommandIndex;
            for ($i = $this->nextCommandIndex; $i < count($this->commands); $i++) {
                $this->commands[$i]->destroy();
            }
            $this->commands = $this->commands->slice(0, $this->nextCommandIndex);
        } else {
            $command->execute();
            $this->commands->push($command);
            ++$this->nextCommandIndex;
        }

        if (count($this->commands) > self::MAX_COMMANDS) {
            $from = count($this->commands) - self::MAX_COMMANDS;
            $to = count($this->commands) - 1;

            // destroy commands before unset
            for ($i = 0; $i < $from; $i++) {
                $this->commands[$i]->destroy();
            }
            if ($to + 1 < count($this->commands)) {
                for ($i = $to + 1; $i < count($this->commands); $i++) {
                    $this->commands[$i]->destroy();
                }
            }

            $this->commands = $this->commands->slice($from, $to);
            $this->nextCommandIndex -= $from;
        }
    }
}