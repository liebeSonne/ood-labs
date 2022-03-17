<?php

namespace App\Robot\Menu;

use App\Robot\Command\CommandInterface;

class Item
{
    private string $shortcut;
    private string $description;
    private CommandInterface $command;

    public function __construct(string $shortcut, string $description, CommandInterface $command)
    {
        $this->shortcut = $shortcut;
        $this->description = $description;
        $this->command = $command;
    }

    public function getShortcut(): string
    {
        return $this->shortcut;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCommand(): CommandInterface
    {
        return $this->command;
    }
}