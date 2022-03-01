<?php

namespace App;

use App\Command\Menu\MenuExitCommand;
use App\Command\Menu\MenuHelpCommand;
use App\Menu\Menu;

class AppMenu
{
    private $stream;
    private Menu $menu;

    public function __construct($stream = STDIN)
    {
        $this->stream = $stream;
        $this->menu = new Menu($this->stream);

        $this->menu->addItem('help', 'Help', new MenuHelpCommand($this->menu));
        $this->menu->addItem('exit', 'Exit', new MenuExitCommand($this->menu));
    }

    public function main(): void
    {
        $this->menu->showInstructions();
        $this->menu->run();
    }
}