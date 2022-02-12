<?php

namespace Tests\Unit\Command\Editor;

use App\Command\Editor\EditorSaveCommand;
use App\Editor\Editor;
use PHPUnit\Framework\TestCase;

class EditorSaveCommandTest extends TestCase
{
    public function testExecute(): void
    {
        $editor = $this->createMock(Editor::class);

        $command = new EditorSaveCommand($editor);

        $editor->expects($this->once())->method('save');

        $command->execute();
    }
}