<?php

namespace App\Machine\WithState\Multi\State;

use App\Machine\Common\Machine\MultiGumballMachineInterface;
use App\Machine\WithState\Multi\State\SoldOutState;
use PHPUnit\Framework\TestCase;

class SoldOutStateTest extends TestCase
{
    /**
     * @var SoldOutState
     */
    private SoldOutState $state;

    /**
     * @var MultiGumballMachineInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    private MultiGumballMachineInterface $machine;

    public function testInsertQuarter(): void
    {
        $str = "You can't insert a quarter, the machine is sold out\n";
        $this->expectOutputString($str);

        $this->state->insertQuarter();
    }

    public function testEjectQuarter(): void
    {
        $maxQuarterCount = 5;
        $quarterCount = 0;
        $this->machine->method('getMaxQuarterCount')->willReturn($maxQuarterCount);
        $this->machine->method('getQuarterCount')->willReturn($quarterCount);

        $str = "You can't eject, you haven't inserted a quarter yet\n";
        $this->expectOutputString($str);

        $this->state->ejectQuarter();
    }

    public function testEjectQuarterHasQuarter(): void
    {
        $maxQuarterCount = 5;
        $quarterCount = 2;
        $this->machine->method('getMaxQuarterCount')->willReturn($maxQuarterCount);
        $this->machine->method('getQuarterCount')->willReturn($quarterCount);

        $str = "$quarterCount Quarter returned\n";
        $this->expectOutputString($str);

        $this->state->ejectQuarter();
    }

    public function testTurnCrank(): void
    {
        $str = "You turned but there's no gumballs\n";
        $this->expectOutputString($str);

        $this->state->turnCrank();
    }

    public function testDispenseEmpty(): void
    {
        $str = "No gumball dispensed\n";
        $this->expectOutputString($str);

        $this->state->dispense();
    }

    public function testToString(): void
    {
        $this->assertEquals("sold out", $this->state->toString());
    }

    public function testRefillQuarterNull(): void
    {
        $numBalls = 5;
        $maxQuarterCount = 5;
        $quarterCount = 0;

        $this->machine->method('getBallCount')->willReturn($numBalls);
        $this->machine->method('getMaxQuarterCount')->willReturn($maxQuarterCount);
        $this->machine->method('getQuarterCount')->willReturn($quarterCount);

        $this->machine->expects($this->once())->method('getBallCount');
        $this->machine->expects($this->once())->method('setNoQuarterState');

        $this->state->refill($numBalls);
    }

    public function testRefillQuarterNotNull(): void
    {
        $numBalls = 5;
        $maxQuarterCount = 5;
        $quarterCount = 2;

        $this->machine->method('getBallCount')->willReturn($numBalls);
        $this->machine->method('getMaxQuarterCount')->willReturn($maxQuarterCount);
        $this->machine->method('getQuarterCount')->willReturn($quarterCount);

        $this->machine->expects($this->once())->method('getBallCount');
        $this->machine->expects($this->once())->method('setHasQuarterState');

        $this->state->refill($numBalls);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->machine = $this->createMock(MultiGumballMachineInterface::class);
        $this->state = new SoldOutState($this->machine);
    }
}
