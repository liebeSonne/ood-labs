<?php

namespace App\Machine\Common\Machine;

interface MultiGumballMachineInterface extends  GumballMachineInterface
{
    public function getQuarterCount(): int;
    public function setQuarterCount(int $count): void;
}