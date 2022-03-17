<?php

namespace App\Robot\Menu;

use App\Robot\Command\CommandInterface;

class Menu
{
    /**
     * @var Item[]
     */
    private array $items = [];

    private bool $isExit = false;

    private $stream;

    public function __construct($stream = STDIN)
    {
        $this->stream = $stream;
    }

    public function addItem(string $shortcut, string $description, CommandInterface $command): void
    {
        $this->items[] = new Item($shortcut, $description, $command);
    }

    public function getItemCommand(string $shortcut): ?CommandInterface
    {
        $command = null;
        foreach ($this->items as $item) {
            if ($item->getShortcut() === $shortcut) {
                $command = $item->getCommand();
                break;
            }
        }
        return $command;
    }

    public function run(): void
    {
        $do = true;
        echo ">";
        while ($do) {
            $command = stream_get_line($this->stream, 65535, "\n");
            $do = $this->executeCommand($command);
            echo ">";
        }
    }

    public function executeCommand(string $shortcut): bool
    {
        $this->isExit = false;
        $command = $this->getItemCommand($shortcut);
        if ($command === null) {
            echo "Unknown command\n";
        } else {
            $command->execute();
        }
        return !$this->isExit;
    }

    public function showInstructions(): void
    {
        echo "Commands list:\n";
        foreach ($this->items as $item) {
            echo " " . $item->getShortcut() . ": " . $item->getDescription() . "\n";
        }
    }
    public function exit(): void
    {
        $this->isExit = true;
    }
}