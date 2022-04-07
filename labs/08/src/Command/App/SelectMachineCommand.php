<?php

namespace App\Command\App;

use App\Command\CommandInterface;
use App\AppMenu;
use App\Machine\Common\Machine\GumballMachineUserInterface;

class SelectMachineCommand implements CommandInterface
{
    private AppMenu $app;
    private GumballMachineUserInterface $machine;

    public function __construct(AppMenu $app, GumballMachineUserInterface $machine)
    {
        $this->app = $app;
        $this->machine = $machine;
    }

    public function execute(): void
    {
        $this->app->selectMachine($this->machine);
    }
}