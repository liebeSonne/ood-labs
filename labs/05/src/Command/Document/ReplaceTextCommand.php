<?php

namespace App\Command\Document;

use App\Command\AbstractCommand;
use App\Model\Paragraph\ParagraphInterface;

class ReplaceTextCommand extends AbstractCommand
{
    private ParagraphInterface $paragraph;
    private string $newText;
    private string $oldText;

    public function __construct(ParagraphInterface &$paragraph, string $text)
    {
        $this->paragraph = $paragraph;
        $this->newText = $text;
        $this->oldText = $this->paragraph->getText();
    }

    protected function doExecute(): void
    {
        $this->oldText = $this->paragraph->getText();
        $this->paragraph->setText($this->newText);
    }

    protected function doUnexecute(): void
    {
        $this->paragraph->setText($this->oldText);
    }
}