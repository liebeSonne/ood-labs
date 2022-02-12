<?php

namespace App\Robot\Command;

use App\Robot\Robot;

class WalkCommand extends CommandExecute
{
    private Robot $robot;
    private string $direction;

    public function __construct(Robot &$robot, string $direction)
    {
        $this->robot = $robot;
        $this->direction = $direction;
    }

    public function execute(): void
    {
        $this->robot->walk($this->direction);
    }
}