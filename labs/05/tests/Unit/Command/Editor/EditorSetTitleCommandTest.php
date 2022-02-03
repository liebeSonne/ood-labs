<?php

namespace Tests\Unit\Command\Editor;

use App\Command\Editor\EditorSetTitleCommand;
use App\Editor\Editor;
use PHPUnit\Framework\TestCase;

class EditorSetTitleCommandTest extends TestCase
{
    public function testExecute(): void
    {
        $editor = $this->createMock(Editor::class);

        $command = new EditorSetTitleCommand($editor);

        $editor->expects($this->once())->method('setTitle');

        $command->execute();
    }
}