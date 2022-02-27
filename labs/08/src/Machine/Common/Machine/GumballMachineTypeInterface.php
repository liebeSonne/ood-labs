<?php

namespace App\Machine\Common\Machine;

interface GumballMachineTypeInterface
{
    public function insertQuarter(): void;
    public function ejectQuarter(): void;
    public function turnCrank(): void;
//    public function dispense(): void;
    public function toString(): string;
    public function refill(int $numBalls): void;
}