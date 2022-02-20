<?php

namespace App;

use App\Machine\Common\Machine\GumballMachineTypeInterface;
use App\Machine\Naive\GumballMachine as NaiveGumballMachine;
use App\Machine\DynamicState\GumballMachine as DynamicGumballMachine;
use App\Machine\WithState\GumballMachine as WithStateGumballMachine;

class App
{
    public function main(): void
    {
        $this->testNaiveGumballMachine();

        echo "\n-----------------\n";
        $this->testGumballMachineWithState();

        echo "\n-----------------\n";
        $this->testGumballMachineWithDynamicState();
    }

    public function TestGumballMachine(GumballMachineTypeInterface $machine): void
    {
        echo  $machine->toString() . "\n";

        $machine->insertQuarter();;
        $machine->turnCrank();

        echo $machine->toString() . "\n";

        $machine->insertQuarter();
        $machine->ejectQuarter();
        $machine->turnCrank();

        echo $machine->toString() . "\n";

        $machine->insertQuarter();
        $machine->turnCrank();
        $machine->insertQuarter();
        $machine->turnCrank();
        $machine->ejectQuarter();

        echo $machine->toString() . "\n";

        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->turnCrank();
        $machine->insertQuarter();
        $machine->turnCrank();
        $machine->insertQuarter();
        $machine->turnCrank();

        echo $machine->toString() . "\n";
    }

    public function testNaiveGumballMachine(): void
    {
        $numBalls = 5;
        $machine = new NaiveGumballMachine($numBalls);
        $this->testGumballMachine($machine);
    }

    public function testGumballMachineWithState(): void
    {
        $numBalls = 5;
        $machine = new WithStateGumballMachine($numBalls);
        $this->testGumballMachine($machine);
    }

    public function testGumballMachineWithDynamicState(): void
    {
        $numBalls = 5;
        $machine = new DynamicGumballMachine($numBalls);
        $this->testGumballMachine($machine);
    }

}