<?php

namespace Tests\Unit\Machine\Common\State;

use App\Machine\Common\Machine\GumballMachineInterface;
use App\Machine\Common\State\SoldState;
use PHPUnit\Framework\TestCase;

class SoldStateTest extends TestCase
{
    /**
     * @var SoldState
     */
    private SoldState $state;

    /**
     * @var GumballMachineInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    private GumballMachineInterface $machine;

    public function testInsertQuarter(): void
    {
        $str = "Please wait, we're already giving you a gumball\n";
        $this->expectOutputString($str);

        $this->state->insertQuarter();
    }

    public function testEjectQuarter(): void
    {
        $str = "Sorry you already turned the crank\n";
        $this->expectOutputString($str);

        $this->state->ejectQuarter();
    }

    public function testTurnCrank(): void
    {
        $str = "Turning twice doesn't get you another gumball\n";
        $this->expectOutputString($str);

        $this->state->turnCrank();
    }

    public function testDispenseEmpty(): void
    {
        $this->machine->method('getBallCount')->willReturn(0);

        $str = "Oops, out of gumballs\n";
        $this->expectOutputString($str);
        $this->machine->expects($this->once())->method('releaseBall');
        $this->machine->expects($this->once())->method('setSoldOutState');

        $this->state->dispense();
    }

    public function testDispenseNotEmpty(): void
    {
        $this->machine->method('getBallCount')->willReturn(5);

        $this->machine->expects($this->once())->method('releaseBall');
        $this->machine->expects($this->once())->method('setNoQuarterState');

        $this->state->dispense();
    }

    public function testToString(): void
    {
        $this->assertEquals("delivering a gumball", $this->state->toString());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->machine = $this->createMock(GumballMachineInterface::class);
        $this->state = new SoldState($this->machine);
    }
}
