<?php

namespace App\Command\Editor;

use App\Command\ActionCommandInterface;
use App\Editor\Editor;

class EditorSetTitleCommand implements ActionCommandInterface
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
}