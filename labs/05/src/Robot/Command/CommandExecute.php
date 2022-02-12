<?php

namespace App\Robot\Command;

use App\Command\CommandInterface;

abstract class CommandExecute implements CommandInterface
{
    abstract public function execute(): void;

    public function unexecute(): void
    {

    }
}