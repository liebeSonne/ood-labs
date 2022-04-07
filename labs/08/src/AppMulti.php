<?php

namespace App;

use App\Machine\Common\Machine\GumballMachineUserInterface;
use App\Machine\Naive\Multi\MultiGumballMachine as NativeMultiGumballMachine;
use App\Machine\WithState\Multi\MultiGumballMachine as WithStateMultiGumballMachine;

class AppMulti
{
    public function main(): void
    {
        $this->testNaiveMultiGumballMachine();

        echo "\n-----------------\n";
        $this->testMultiGumballMachineWithState();
    }

    public function TestMultiGumballMachine(GumballMachineUserInterface $machine): void
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
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->turnCrank();
        $machine->turnCrank();

        echo $machine->toString() . "\n";

        $machine->ejectQuarter();
        $machine->turnCrank();


        echo $machine->toString() . "\n";
    }

    public function testNaiveMultiGumballMachine(): void
    {
        $numBalls = 5;
        $maxQuarter = 5;
        $machine = new NativeMultiGumballMachine($numBalls, $maxQuarter);
        $this->testMultiGumballMachine($machine);
    }

    public function testMultiGumballMachineWithState(): void
    {
        $numBalls = 5;
        $maxQuarter = 5;
        $machine = new WithStateMultiGumballMachine($numBalls, $maxQuarter);
        $this->testMultiGumballMachine($machine);
    }

}