<?php

namespace App\Command\Machine;

use App\Command\CommandInterface;
use App\Machine\Common\Machine\GumballMachineUserInterface;

class ShowStateCommand implements CommandInterface
{
    private GumballMachineUserInterface $machine;

    public function __construct(GumballMachineUserInterface &$machine)
    {
        $this->machine = $machine;
    }

    public function execute(): void
    {
        echo $this->machine->toString();
    }
}