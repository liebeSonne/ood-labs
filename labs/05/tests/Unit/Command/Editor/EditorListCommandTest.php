<?php

namespace Tests\Unit\Command\Editor;

use App\Command\Editor\EditorListCommand;
use App\Editor\Editor;
use PHPUnit\Framework\TestCase;

class EditorListCommandTest extends TestCase
{
    public function testExecute(): void
    {
        $editor = $this->createMock(Editor::class);

        $command = new EditorListCommand($editor);

        $editor->expects($this->once())->method('list');

        $command->execute();
    }
}