<?php

namespace App\Robot\Command;

use App\Command\CommandInterface;
use App\Robot\Robot;

class MacroCommand extends CommandExecute
{
    /**
     * @var CommandInterface[]
     */
    private array $commands;

    public function execute(): void
    {
        foreach ($this->commands as $command) {
            $command->execute();
        }
    }

    public function addCommand(CommandInterface $command): void
    {
        $this->commands[] = $command;
    }
}