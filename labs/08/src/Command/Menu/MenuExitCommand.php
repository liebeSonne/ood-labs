<?php

namespace App\Command\Menu;

use App\Command\CommandInterface;
use App\Menu\Menu;

class MenuExitCommand implements CommandInterface
{
    private Menu $menu;
    private ?Menu $prevMenu = null;

    public function __construct(Menu $menu, ?Menu $prevMenu = null)
    {
        $this->menu = $menu;
        $this->prevMenu = $prevMenu;
    }

    public function execute(): void
    {
        $this->menu->exit();
        if ($this->prevMenu !== null) {
            $this->prevMenu->showInstructions();
        }
    }
}