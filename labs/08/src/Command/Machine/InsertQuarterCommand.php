<?php

namespace App\Command\Machine;

use App\Command\CommandInterface;
use App\Machine\Common\Machine\GumballMachineUserInterface;

class InsertQuarterCommand implements CommandInterface
{
    private GumballMachineUserInterface $machine;

    public function __construct(GumballMachineUserInterface &$machine)
    {
        $this->machine = $machine;
    }

    public function execute(): void
    {
        $this->machine->insertQuarter();
    }
}