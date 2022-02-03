<?php

namespace Tests\Unit\Command\Menu;

use App\Command\Menu\MenuExitCommand;
use App\Menu\Menu;
use PHPUnit\Framework\TestCase;

class MenuExitCommandTest extends TestCase
{
    public function testExecute(): void
    {
        $menu = $this->createMock(Menu::class);

        $command = new MenuExitCommand($menu);

        $menu->expects($this->once())->method('exit');

        $command->execute();
    }
}
