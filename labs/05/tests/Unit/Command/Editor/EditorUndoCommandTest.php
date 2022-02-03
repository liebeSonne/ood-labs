<?php

namespace Tests\Unit\Command\Editor;

use App\Command\Editor\EditorUndoCommand;
use App\Editor\Editor;
use PHPUnit\Framework\TestCase;

class EditorUndoCommandTest extends TestCase
{
    public function testExecute(): void
    {
        $editor = $this->createMock(Editor::class);

        $command = new EditorUndoCommand($editor);

        $editor->expects($this->once())->method('undo');

        $command->execute();
    }

    public function testUnexecute(): void
    {
        $editor = $this->createMock(Editor::class);

        $command = new EditorUndoCommand($editor);

        $editor->expects($this->once())->method('redo');

        $command->unexecute();
    }
}