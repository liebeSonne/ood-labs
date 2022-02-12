<?php

namespace Tests\Unit\Command\Document;

use App\Command\Document\ReplaceTextCommand;
use App\Model\Paragraph\Paragraph;
use PHPUnit\Framework\TestCase;

class ReplaceTextCommandTest extends TestCase
{
    public function testDoExecute(): void
    {
        $newText = 'new text';
        $oldText = 'old text';

        $paragraph = new Paragraph($oldText);

        $this->assertEquals($oldText, $paragraph->getText());

        $command = new ReplaceTextCommand($paragraph, $newText);

        $command->execute();

        $this->assertEquals($newText, $paragraph->getText());
    }

    public function testDoUnexecute(): void
    {
        $oldText = 'old text';
        $newText = 'new text';

        $paragraph = new Paragraph($oldText);

        $command = new ReplaceTextCommand($paragraph, $newText);

        $command->execute();
        $command->unexecute();

        $this->assertEquals($oldText, $paragraph->getText());
    }
}