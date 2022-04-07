<?php

namespace App\Command\Machine;

use App\Command\CommandInterface;
use App\Machine\Common\Machine\GumballMachineUserInterface;

class RefillCommand implements CommandInterface
{
    private GumballMachineUserInterface $machine;
    private int $numBalls;

    public function __construct(GumballMachineUserInterface &$machine, int $numBalls)
    {
        $this->machine = $machine;
        $this->numBalls = $numBalls;
    }

    public function execute(): void
    {
        $this->machine->refill($this->numBalls);
    }
}