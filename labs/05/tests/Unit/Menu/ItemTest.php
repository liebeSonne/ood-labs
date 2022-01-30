<?php

namespace Tests\Unit\Menu;

use App\Command\CommandInterface;
use App\Menu\Item;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    public function testGetters(): void
    {
        $shortcut = 'some_struct';
        $description = 'some_struct description';
        $command = $this->createMock(CommandInterface::class);

        $item = new Item($shortcut, $description, $command);

        $this->assertEquals($shortcut, $item->getShortcut());
        $this->assertEquals($description, $item->getDescription());
        $this->assertEquals($command, $item->getCommand());
    }
}