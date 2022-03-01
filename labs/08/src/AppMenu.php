<?php

namespace App;

use App\Command\App\MachineMenuCommand;
use App\Command\App\SelectMachineCommand;
use App\Command\Menu\MenuExitCommand;
use App\Command\Menu\MenuHelpCommand;
use App\Machine\Common\Machine\GumballMachineTypeInterface;
use App\Machine\Naive\GumballMachine as NaiveGumballMachine;
use App\Machine\Naive\Multi\MultiGumballMachine as NaiveMultiGumballMachine;
use App\Machine\WithState\GumballMachine as WithStateGumballMachine;
use App\Machine\DynamicState\GumballMachine as DynamicStateGumballMachine;
use App\Machine\WithState\Multi\MultiGumballMachine as WithStateMultiGumballMachine;
use App\Menu\Menu;

class AppMenu
{
    private $stream;
    private Menu $menu;
    private Menu $machineMenu;
    private int $defaultCountBalls = 5;
    private int $defaultMaxQuarter = 5;

    public function __construct($stream = STDIN)
    {
        $this->stream = $stream;
        $this->menu = new Menu($this->stream);

        $this->menu->addItem('help', 'Help', new MenuHelpCommand($this->menu));
        $this->menu->addItem('exit', 'Exit', new MenuExitCommand($this->menu));

        $this->menu->addItem('machine', 'Run Gumball machine', new MachineMenuCommand($this));
    }

    public function main(): void
    {
        $this->menu->showInstructions();
        $this->menu->run();
    }

    public function machineMenu(): void
    {
        $this->machineMenu = new Menu($this->stream);

        $this->machineMenu->addItem('help', 'Help and machine list', new MenuHelpCommand($this->machineMenu));
        $this->machineMenu->addItem('back', 'Exit from machine menu', new MenuExitCommand($this->machineMenu));


        $this->machineMenu->addItem('naive', 'Select naive machine', new SelectMachineCommand($this, new NaiveGumballMachine($this->defaultCountBalls)));
        $this->machineMenu->addItem('state', 'Select state machine', new SelectMachineCommand($this, new WithStateGumballMachine($this->defaultCountBalls)));
        $this->machineMenu->addItem('state-dynamic', 'Select state dynamic machine', new SelectMachineCommand($this, new DynamicStateGumballMachine($this->defaultCountBalls)));
        $this->machineMenu->addItem('naive-multi', 'Select naive multi machine', new SelectMachineCommand($this, new NaiveMultiGumballMachine($this->defaultCountBalls)));
        $this->machineMenu->addItem('state-multi', 'Select state multi machine', new SelectMachineCommand($this, new WithStateMultiGumballMachine($this->defaultMaxQuarter)));

        echo "Choice machine:\n";
        $this->machineMenu->showInstructions();
        $this->machineMenu->run();
    }

    public function selectMachine(GumballMachineTypeInterface $machine): void
    {
        $this->machine = $machine;
    }
}