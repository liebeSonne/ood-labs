<?php

namespace App;

use App\Command\Machine\EjectQuarterCommand;
use App\Command\App\MachineMenuCommand;
use App\Command\Machine\InsertQuarterCommand;
use App\Command\Machine\RefillCommand;
use App\Command\App\SelectMachineCommand;
use App\Command\Machine\ShowStateCommand;
use App\Command\Machine\TurnCrankCommand;
use App\Command\Menu\MenuExitCommand;
use App\Command\Menu\MenuHelpCommand;
use App\Machine\Common\Machine\GumballMachineStateInterface;
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
    private Menu $controlMenu;
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
        $this->machineMenu->addItem('back', 'Exit from machine menu', new MenuExitCommand($this->machineMenu, $this->menu));

        $this->machineMenu->addItem('naive', 'Select naive machine', new SelectMachineCommand($this, new NaiveGumballMachine($this->defaultCountBalls)));
        $this->machineMenu->addItem('state', 'Select state machine', new SelectMachineCommand($this, new WithStateGumballMachine($this->defaultCountBalls)));
        $this->machineMenu->addItem('state-dynamic', 'Select state dynamic machine', new SelectMachineCommand($this, new DynamicStateGumballMachine($this->defaultCountBalls)));
        $this->machineMenu->addItem('naive-multi', 'Select naive multi machine', new SelectMachineCommand($this, new NaiveMultiGumballMachine($this->defaultCountBalls)));
        $this->machineMenu->addItem('state-multi', 'Select state multi machine', new SelectMachineCommand($this, new WithStateMultiGumballMachine($this->defaultMaxQuarter)));

        echo "#--- Choice machine ---#\n";
        $this->machineMenu->showInstructions();
        $this->machineMenu->run();
    }

    public function selectMachine(GumballMachineStateInterface $machine): void
    {
        $this->machine = $machine;

        $this->controlMenu = new Menu($this->stream);

        $this->controlMenu->addItem('h', 'Help - command list', new MenuHelpCommand($this->controlMenu));
        $this->controlMenu->addItem('q', 'Exit from machine', new MenuExitCommand($this->controlMenu, $this->machineMenu));

        $this->controlMenu->addItem('i', 'Insert Quarter', new InsertQuarterCommand($this->machine));
        $this->controlMenu->addItem('e', 'Eject Quarter', new EjectQuarterCommand($this->machine));
        $this->controlMenu->addItem('t', 'Turn Crank', new TurnCrankCommand($this->machine));
        $this->controlMenu->addItem('s', 'Show machine state', new ShowStateCommand($this->machine));
        $this->controlMenu->addItem('r', 'Refill balls', new RefillCommand($this->machine, $this->defaultCountBalls));

        echo "#--- Gumball Machine ---#\n";
        $this->controlMenu->showInstructions();
        $this->controlMenu->run();
    }
}