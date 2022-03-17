<?php

namespace App\Robot\Command;

abstract class CommandExecute implements CommandInterface
{
    abstract public function execute(): void;
}