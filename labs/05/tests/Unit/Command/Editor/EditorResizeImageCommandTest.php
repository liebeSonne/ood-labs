<?php

namespace Tests\Unit\Command\Editor;

use App\Command\Editor\EditorInsertParagraph;
use App\Command\Editor\EditorReplaceTextCommand;
use App\Command\Editor\EditorResizeImageCommand;
use App\Editor\Editor;
use PHPUnit\Framework\TestCase;

class EditorResizeImageCommandTest extends TestCase
{
    public function testExecute(): void
    {
        $editor = $this->createMock(Editor::class);

        $command = new EditorResizeImageCommand($editor);

        $editor->expects($this->once())->method('resizeImage');

        $command->execute();
    }
}