<?php

namespace Tests\Unit\Command\Editor;

use App\Command\Editor\EditorInsertParagraph;
use App\Command\Editor\EditorReplaceTextCommand;
use App\Editor\Editor;
use PHPUnit\Framework\TestCase;

class EditorReplaceTextCommandTest extends TestCase
{
    public function testExecute(): void
    {
        $editor = $this->createMock(Editor::class);

        $command = new EditorReplaceTextCommand($editor);

        $editor->expects($this->once())->method('replaceText');

        $command->execute();
    }
}