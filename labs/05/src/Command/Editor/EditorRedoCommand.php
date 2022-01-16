<?php

namespace App\Command\Editor;

use App\Command\CommandInterface;
use App\Editor\Editor;

class EditorRedoCommand implements CommandInterface
{
    private Editor $editor;

    public function __construct(Editor $editor)
    {
        $this->editor = $editor;
    }

    public function execute(): void
    {
        $this->editor->redo();
    }

    public function unexecute(): void
    {
        $this->editor->undo();
    }
}