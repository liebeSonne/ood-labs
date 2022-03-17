<?php

namespace App\Robot\CommandMain;

use App\Robot\Command\CommandInterface;
use App\Menu\Menu;
use App\Robot\RobotMenu;

class ClassicPatternMenuCommand implements CommandInterface
{
    private Menu $menu;
    private $stream;
    private RobotMenu $robotMenu;

    public function __construct(Menu $menu, $stream = STDIN)
    {
        $this->menu = $menu;
        $this->stream = $stream;
    }

    public function execute(): void
    {
        $this->robotMenu = new RobotMenu($this->stream);
        $this->menu->showInstructions();
    }
}