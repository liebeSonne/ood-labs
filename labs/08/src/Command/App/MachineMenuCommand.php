<?php

namespace App\Command\App;

use App\Command\CommandInterface;
use App\AppMenu;

class MachineMenuCommand implements CommandInterface
{
    private AppMenu $app;

    public function __construct(AppMenu $app)
    {
        $this->app = $app;
    }

    public function execute(): void
    {
        $this->app->machineMenu();
    }

    public function unexecute(): void
    {

    }
}