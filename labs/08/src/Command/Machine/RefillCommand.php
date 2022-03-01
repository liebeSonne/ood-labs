<?php

namespace App\Command\Machine;

use App\Command\CommandInterface;
use App\Machine\Common\Machine\GumballMachineTypeInterface;

class RefillCommand implements CommandInterface
{
    private GumballMachineTypeInterface $machine;
    private int $numBalls;

    public function __construct(GumballMachineTypeInterface &$machine, int $numBalls)
    {
        $this->machine = $machine;
        $this->numBalls = $numBalls;
    }

    public function execute(): void
    {
        $this->machine->refill($this->numBalls);
    }

    public function unexecute(): void
    {

    }
}