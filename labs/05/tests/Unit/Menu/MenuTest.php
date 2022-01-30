<?php

namespace Tests\Unit\Menu;

use App\Command\CommandInterface;
use App\Menu\Menu;
use PHPUnit\Framework\TestCase;

class MenuTest extends TestCase
{
    public function testRun(): void
    {
        $stream = fopen('php://temp', 'w+b');
        fwrite($stream, "shortcut_command\n");
        fseek($stream, 0);

        $menu = $this->getMockBuilder(Menu::class)
            ->setConstructorArgs([$stream])
            ->setMethodsExcept(['run'])
            ->getMock();

        $menu->expects($this->once())->method('executeCommand');

        $menu->run();
    }

    public function testExecuteCommandOk(): void
    {
        $shortcut = 'test_shortcut';
        $description = 'test_shortcut description';
        $command = $this->createMock(CommandInterface::class);

        $stream = STDIN;
        $menu = new Menu($stream);

        $menu->addItem($shortcut, $description, $command);

        $command->expects($this->once())->method('execute');

        $result = $menu->executeCommand($shortcut);

        $this->assertTrue($result);
    }

    public function testExecuteCommandError(): void
    {
        $shortcut = 'test_shortcut';

        $stream = STDIN;
        $menu = new Menu($stream);

        $this->expectOutputString("Unknown command\n");

        $result = $menu->executeCommand($shortcut);

        $this->assertTrue($result);
    }

    public function testShowInstructionsEmpty(): void
    {
        $stream = STDIN;
        $menu = new Menu($stream);

        $this->expectOutputString("Commands list:\n");

        $menu->showInstructions();
    }

    public function testShowInstructionsList(): void
    {
        $shortcut = 'test_shortcut';
        $description = 'test_shortcut description';
        $command = $this->createMock(CommandInterface::class);

        $stream = STDIN;
        $menu = new Menu($stream);

        $menu->addItem($shortcut, $description, $command);

        $text = "Commands list:\n";
        $text .= " " . $shortcut . ": " . $description . "\n";

        $this->expectOutputString($text);

        $menu->showInstructions();
    }

}