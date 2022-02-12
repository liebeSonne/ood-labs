<?php

namespace Tests\Unit\Robot\Command;

use App\Command\CommandInterface;
use App\Menu\Menu;
use App\Robot\Command\BeginMacroCommand;
use PHPUnit\Framework\TestCase;

class BeginMacroCommandTest extends TestCase
{
    public function testExecute(): void
    {
        $menu = new Menu();
        $menu->addItem('a', 'a description', $this->createMock(CommandInterface::class));
        $menu->addItem('b', 'b description', $this->createMock(CommandInterface::class));

        $name = 'testname';
        $stream = fopen('php://temp', 'w+b');
        fwrite($stream, $name . "\n");
        fwrite($stream, "test description\n");
        fwrite($stream, "a\n");
        fwrite($stream, "b\n");
        fwrite($stream, "a\n");
        fwrite($stream, "a\n");
        fwrite($stream, "b\n");
        fwrite($stream, "end_macro\n");
        fseek($stream, 0);

        $command = new BeginMacroCommand($menu, $stream);

        $command->execute();

        $this->assertNotNull($menu->getItemCommand($name));
    }
}