<?php

namespace App\Command\Menu;

use App\Command\CommandInterface;
use App\Menu\Menu;

class MenuHelpCommand implements CommandInterface
{
    private Menu $menu;

    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }

    public function execute(): void
    {
        $this->menu->showInstructions();
    }

    public function unexecute(): void
    {

    }
}