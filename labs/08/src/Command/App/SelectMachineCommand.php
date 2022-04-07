<?php

namespace App\Command\App;

use App\Command\CommandInterface;
use App\AppMenu;
use App\Machine\Common\Machine\GumballMachineStateInterface;

class SelectMachineCommand implements CommandInterface
{
    private AppMenu $app;
    private GumballMachineStateInterface $machine;

    public function __construct(AppMenu $app, GumballMachineStateInterface $machine)
    {
        $this->app = $app;
        $this->machine = $machine;
    }

    public function execute(): void
    {
        $this->app->selectMachine($this->machine);
    }
}