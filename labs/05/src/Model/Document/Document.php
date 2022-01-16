<?php

namespace App\Model\Document;

use App\Command\Document\ChangeStringCommand;
use App\Model\History\History;

class Document implements DocumentInterface
{
    private string $title = '';

    private History $history;

    public function __construct()
    {
        $this->history = new History();
    }

    //public function insertParagraph(string $text, ?int $position = null): ParagraphInterface;

    //public function insertImage(string $path, int $width, int $height, ?int $position = null): ImageInterface;

    //public function getItemCount(): int;

    //public function getItem(int $index): ConstDocumentItem;

    //public function getItem(int $index): DocumentItem;

    //public function deleteItem(int $index): void;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->history->addAndExecuteCommand(new ChangeStringCommand($this->title, $title));
    }

    public function canUndo(): bool
    {
        return $this->history->canUndo();
    }

    public function undo(): void
    {
        $this->history->undo();
    }

    public function canRedo(): bool
    {
        return $this->history->canRedo();
    }

    public function redo(): void
    {
        $this->history->redo();
    }

    //public function save(string $path): void;
}