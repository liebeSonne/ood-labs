<?php

namespace App\Robot\Command;

use App\Robot\Menu\Menu;

class BeginMacroCommand extends CommandExecute
{
    public const END_MACRO = 'end_macro';

    private Menu $menu;
    private $stream;
    private array $robotCommands;

    public function __construct(Menu &$menu, $stream = STDIN, array $robotCommands)
    {
        $this->menu = $menu;
        $this->stream = $stream;
        $this->robotCommands = $robotCommands;
    }

    public function execute(): void
    {
        $name = $this->readName();

        $description = $this->readDescription();

        $count = 0;
        $macro = new MacroCommand();
        $do = true;
        echo "Write commands list (to finish, write: `end_macro`. to abort, write: `abort`):\n";
        while ($do) {
            echo ">";
            $command = stream_get_line($this->stream, 65535, "\n");
            $command = trim($command);
            if ($command == 'abort') {
                echo "Error: Macro command record aborted\n";
              return;
            } if ($command === self::END_MACRO) {
                $do = false;
            } else {
                $cmd = $this->menu->getItemCommand($command);
                if ($cmd === null) {
                    echo "Error: Unknown command `" . $command . "`\n";
                } else {
                    if (in_array($command, $this->robotCommands)) {
                        $macro->addCommand($cmd);
                        $count++;
                    } else {
                        $cmd->execute();
                    }
                }
            }
        }

        if ($count > 0) {
            $this->menu->addItem($name, $description, $macro);
            $this->robotCommands[] = $name;
            echo "Ok. Command created (count commands: $count).\n";
        } else {
            echo "Error: Can;t crete command width empty commands list\n";
        }
    }

    private function readName(): string
    {
        $name = '';
        while(empty($name)) {
            echo "Write command <name>\n";
            echo ">";
            $name = stream_get_line($this->stream, 65535, "\n");
            $name = trim($name);

            if (!empty($name) && $this->menu->getItemCommand($name) !== null) {
                echo "Error: command `" . $name . "` already exist\n";
                $name = '';
            }
        }
        return $name;
    }

    private function readDescription(): string
    {
        echo "Write command <description>\n";
        echo ">";
        return stream_get_line($this->stream, 65535, "\n");
    }

}