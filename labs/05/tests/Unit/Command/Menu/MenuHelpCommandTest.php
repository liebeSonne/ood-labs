<?php

namespace Tests\Unit\Command\Menu;

use App\Command\Menu\MenuHelpCommand;
use App\Menu\Menu;
use PHPUnit\Framework\TestCase;

class MenuHelpCommandTest extends TestCase
{
    public function testExecute(): void
    {
        $menu = $this->createMock(Menu::class);

        $command = new MenuHelpCommand($menu);

        $menu->expects($this->once())->method('showInstructions');

        $command->execute();
    }
}