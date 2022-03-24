<?php

namespace App\Robot\Command\Menu;

use App\Robot\Command\CommandInterface;
use App\Robot\Menu\Menu;

class MenuExitCommand implements CommandInterface
{
    private Menu $menu;

    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }

    public function execute(): void
    {
        $this->menu->exit();
    }
}