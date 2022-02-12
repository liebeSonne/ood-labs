<?php

namespace Tests\Unit\Command\Document;

use App\Command\Document\ReplaceTextCommand;
use App\Model\Paragraph\ParagraphInterface;
use PHPUnit\Framework\TestCase;

class ReplaceTextCommandText extends TestCase
{
    public function testDoExecute(): void
    {
        $paragraph = $this->createMock(ParagraphInterface::class);
        $newText = 'new text';

        $command = new ReplaceTextCommand($paragraph, $newText);

        $command->execute();

        $this->assertEquals($newText, $paragraph->getText());
    }

    public function testDoUnexecute(): void
    {
        $paragraph = $this->createMock(ParagraphInterface::class);
        $oldText = 'old text';
        $newText = 'new text';

        $paragraph->setText($oldText);

        $command = new ReplaceTextCommand($paragraph, $newText);

        $command->execute();
        $command->unexecute();

        $this->assertEquals($oldText, $paragraph->getText());
    }
}