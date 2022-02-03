<?php

namespace Tests\Unit\Command\Editor;

use App\Command\Editor\EditorRedoCommand;
use App\Editor\Editor;
use PHPUnit\Framework\TestCase;

class EditorRedoCommandTest extends TestCase
{
    public function testExecute(): void
    {
        $editor = $this->createMock(Editor::class);

        $command = new EditorRedoCommand($editor);

        $editor->expects($this->once())->method('redo');

        $command->execute();
    }

    public function testUnexecute(): void
    {
        $editor = $this->createMock(Editor::class);

        $command = new EditorRedoCommand($editor);

        $editor->expects($this->once())->method('undo');

        $command->unexecute();
    }
}