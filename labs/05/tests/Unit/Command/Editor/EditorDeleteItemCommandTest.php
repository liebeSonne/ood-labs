<?php

namespace Tests\Unit\Command\Editor;

use App\Command\Editor\EditorDeleteItemCommand;
use App\Editor\Editor;
use PHPUnit\Framework\TestCase;

class EditorDeleteItemCommandTest extends TestCase
{
    public function testExecute(): void
    {
        $editor = $this->createMock(Editor::class);

        $command = new EditorDeleteItemCommand($editor);

        $editor->expects($this->once())->method('deleteItem');

        $command->execute();
    }
}