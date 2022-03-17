<?php

namespace App\Menu;

use App\Command\ActionCommandInterface;

class Item
{
    private string $shortcut;
    private string $description;
    private ActionCommandInterface $command;

    public function __construct(string $shortcut, string $description, ActionCommandInterface $command)
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

    public function getCommand(): ActionCommandInterface
    {
        return $this->command;
    }
}