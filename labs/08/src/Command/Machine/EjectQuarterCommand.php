<?php

namespace App\Command\Machine;

use App\Command\CommandInterface;
use App\Machine\Common\Machine\GumballMachineTypeInterface;

class EjectQuarterCommand implements CommandInterface
{
    private GumballMachineTypeInterface $machine;

    public function __construct(GumballMachineTypeInterface &$machine)
    {
        $this->machine = $machine;
    }

    public function execute(): void
    {
        $this->machine->ejectQuarter();
    }

    public function unexecute(): void
    {

    }
}