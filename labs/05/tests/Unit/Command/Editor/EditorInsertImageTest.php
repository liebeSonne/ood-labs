<?php

namespace Tests\Unit\Command\Editor;

use App\Command\Editor\EditorInsertImage;
use App\Editor\Editor;
use PHPUnit\Framework\TestCase;

class EditorInsertImageTest extends TestCase
{
    public function testExecute(): void
    {
        $editor = $this->createMock(Editor::class);

        $command = new EditorInsertImage($editor);

        $editor->expects($this->once())->method('insertImage');

        $command->execute();
    }
}