<?php

namespace App\Robot\Command;

use App\Robot\Robot;

class TurnOffCommand extends CommandExecute
{
    private Robot $robot;

    public function __construct(Robot &$robot)
    {
        $this->robot = $robot;
    }

    public function execute(): void
    {
        $this->robot->turnOff();
    }
}