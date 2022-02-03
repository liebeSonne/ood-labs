<?php

namespace Tests\Unit\Command\Editor;

use App\Command\Editor\EditorInsertParagraph;
use App\Editor\Editor;
use PHPUnit\Framework\TestCase;

class EditorInsertParagraphTest extends TestCase
{
    public function testExecute(): void
    {
        $editor = $this->createMock(Editor::class);

        $command = new EditorInsertParagraph($editor);

        $editor->expects($this->once())->method('insertParagraph');

        $command->execute();
    }
}