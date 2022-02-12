<?php

namespace App\Robot\Command;

use App\Menu\Menu;

class BeginMacroCommand extends CommandExecute
{
    public const END_MACRO = 'end_macro';

    private Menu $menu;
    private $stream;

    public function __construct(Menu &$menu, $stream = STDIN)
    {
        $this->menu = $menu;
        $this->stream = $stream;
    }

    public function execute(): void
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

        echo "Write command <description>\n";
        echo ">";
        $description = stream_get_line($this->stream, 65535, "\n");

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
                    $macro->addCommand($cmd);
                    $count++;
                }
            }
        }

        if ($count > 0) {
            $this->menu->addItem($name, $description, $macro);
            echo "Ok. Command created (count commands: $count).\n";
        } else {
            echo "Error: Can;t crete command width empty commands list\n";
        }
    }
}