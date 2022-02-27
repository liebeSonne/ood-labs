<?php

namespace Tests\Unit\Machine\Common\State;

use App\Machine\Common\Machine\GumballMachineInterface;
use App\Machine\Common\State\HasQuarterState;
use PHPUnit\Framework\TestCase;

class HasQuarterStateTest extends TestCase
{
    /**
     * @var HasQuarterState
     */
    private HasQuarterState $state;

    /**
     * @var GumballMachineInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    private GumballMachineInterface $machine;

    public function testInsertQuarter(): void
    {
        $str = "You can't insert another quarter\n";
        $this->expectOutputString($str);

        $this->state->insertQuarter();
    }

    public function testEjectQuarter(): void
    {
        $str = "Quarter returned\n";
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

        $this->machine = $this->createMock(GumballMachineInterface::class);
        $this->state = new HasQuarterState($this->machine);
    }
}
