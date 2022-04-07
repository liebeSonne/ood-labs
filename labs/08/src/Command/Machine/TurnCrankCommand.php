<?php

namespace App\Command\Machine;

use App\Command\CommandInterface;
use App\Machine\Common\Machine\GumballMachineStateInterface;

class TurnCrankCommand implements CommandInterface
{
    private GumballMachineStateInterface $machine;

    public function __construct(GumballMachineStateInterface &$machine)
    {
        $this->machine = $machine;
    }

    public function execute(): void
    {
        $this->machine->turnCrank();
    }
}