<?php

namespace App\Command\Machine;

use App\Command\CommandInterface;
use App\Machine\Common\Machine\GumballMachineStateInterface;

class RefillCommand implements CommandInterface
{
    private GumballMachineStateInterface $machine;
    private int $numBalls;

    public function __construct(GumballMachineStateInterface &$machine, int $numBalls)
    {
        $this->machine = $machine;
        $this->numBalls = $numBalls;
    }

    public function execute(): void
    {
        $this->machine->refill($this->numBalls);
    }
}