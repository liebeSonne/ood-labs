<?php

namespace App\Machine\WithState\Multi\State;

use App\Machine\Common\Machine\MultiGumballMachineInterface;
use App\Machine\WithState\Multi\State\HasQuarterState;
use PHPUnit\Framework\TestCase;

class HasQuarterStateTest extends TestCase
{
    /**
     * @var HasQuarterState
     */
    private HasQuarterState $state;

    /**
     * @var MultiGumballMachineInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    private MultiGumballMachineInterface $machine;

    public function testInsertQuarterNull(): void
    {
        $maxQuarterCount = 0;
        $quarterCount = 0;
        $this->machine->method('getMaxQuarterCount')->willReturn($maxQuarterCount);
        $this->machine->method('getQuarterCount')->willReturn($quarterCount);

        $str = "You can't insert another quarter ($quarterCount / $maxQuarterCount)\n";
        $this->expectOutputString($str);

        $this->state->insertQuarter();
    }

    public function testInsertQuarter(): void
    {
        $maxQuarterCount = 5;
        $quarterCount = 0;
        $this->machine->method('getMaxQuarterCount')->willReturn($maxQuarterCount);
        $this->machine->method('getQuarterCount')->willReturn($quarterCount);
        $quarterCount++;
        $str = "You inserted a quarter ($quarterCount / $maxQuarterCount)\n";
        $this->expectOutputString($str);

        $this->state->insertQuarter();
    }

    public function testInsertQuarterMax(): void
    {
        $maxQuarterCount = 5;
        $quarterCount = 5;
        $this->machine->method('getMaxQuarterCount')->willReturn($maxQuarterCount);
        $this->machine->method('getQuarterCount')->willReturn($quarterCount);
        $str = "You can't insert another quarter ($quarterCount / $maxQuarterCount)\n";
        $this->expectOutputString($str);

        $this->state->insertQuarter();
    }

    public function testEjectQuarter(): void
    {
        $maxQuarterCount = 5;
        $quarterCount = 2;
        $this->machine->method('getMaxQuarterCount')->willReturn($maxQuarterCount);
        $this->machine->method('getQuarterCount')->willReturn($quarterCount);

        $str = "$quarterCount Quarter returned\n";
        $this->expectOutputString($str);
        $this->machine->expects($this->once())->method('setNoQuarterState');

        $this->state->ejectQuarter();
    }

    public function testTurnCrank(): void
    {
        $str = "You turned...\n";
        $this->expectOutputString($str);
        $this->machine->expects($this->once())->method('setSoldState');

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
        $this->assertEquals("waiting for turn of crank", $this->state->toString());
    }


    public function testRefill(): void
    {
        $numBalls = 5;

        $this->machine->method('getBallCount')->willReturn($numBalls);

        $this->machine->expects($this->once())->method('getBallCount');

        $this->state->refill($numBalls);
    }

    public function testRefillNull(): void
    {
        $numBalls = 0;

        $this->machine->method('getBallCount')->willReturn($numBalls);

        $this->machine->expects($this->once())->method('getBallCount');
        $this->machine->expects($this->once())->method('setSoldOutState');

        $this->state->refill($numBalls);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->machine = $this->createMock(MultiGumballMachineInterface::class);
        $this->state = new HasQuarterState($this->machine);
    }
}
