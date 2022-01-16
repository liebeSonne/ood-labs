<?php

namespace App\Command\Editor;

use App\Command\CommandInterface;
use App\Editor\Editor;

class EditorSetTitleCommand implements CommandInterface
{
    private Editor $editor;

    public function __construct(Editor $editor)
    {
        $this->editor = $editor;
    }

    public function execute(): void
    {
        $this->editor->setTitle();
    }

    public function unexecute(): void
    {

    }
}