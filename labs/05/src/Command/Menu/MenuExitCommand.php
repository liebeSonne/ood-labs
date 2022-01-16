<?php

namespace App\Command\Menu;

use App\Command\CommandInterface;
use App\Menu\Menu;

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

    public function unexecute(): void
    {

    }
}