<?php

namespace App\Command\Menu;

use App\Command\ActionCommandInterface;
use App\Menu\Menu;

class MenuExitCommand implements ActionCommandInterface
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