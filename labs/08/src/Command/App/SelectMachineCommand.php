<?php

namespace App\Command\App;

use App\Command\CommandInterface;
use App\AppMenu;
use App\Machine\Common\Machine\GumballMachineTypeInterface;

class SelectMachineCommand implements CommandInterface
{
    private AppMenu $app;
    private GumballMachineTypeInterface $machine;

    public function __construct(AppMenu $app, GumballMachineTypeInterface $machine)
    {
        $this->app = $app;
        $this->machine = $machine;
    }

    public function execute(): void
    {
        $this->app->selectMachine($this->machine);
    }

    public function unexecute(): void
    {

    }
}