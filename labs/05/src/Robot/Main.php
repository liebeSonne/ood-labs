<?php

namespace App\Robot;

use App\Robot\Command\Menu\MenuExitCommand;
use App\Robot\Menu\Menu;
use App\Robot\CommandMain\ClassicPatternMenuCommand;

class Main
{
    private $stream;
    private Menu $menu;

    public function __construct($stream = STDIN)
    {
        $this->stream = $stream;
        $this->menu = new Menu($this->stream);

        $this->menu->addItem('c', 'Classic command pattern implementation', new ClassicPatternMenuCommand($this->menu, $this->stream));
        $this->menu->addItem('q', 'Exit Program', new MenuExitCommand($this->menu));
    }

    public function run(): void
    {
        $this->menu->showInstructions();
        $this->menu->run();
    }
}