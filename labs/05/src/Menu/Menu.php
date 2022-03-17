<?php

namespace App\Menu;

use App\Command\ActionCommandInterface;

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

    public function addItem(string $shortcut, string $description, ActionCommandInterface $command): void
    {
        $this->items[] = new Item($shortcut, $description, $command);
    }

    public function getItemCommand(string $shortcut): ?ActionCommandInterface
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
            if (!empty($command)) {
                $do = $this->executeCommand($command);
                echo ">";
            }
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