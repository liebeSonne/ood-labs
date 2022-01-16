<?php

namespace App\Model\Document;

use App\Command\Document\ChangeStringCommand;
use App\Command\Document\InsertParagraphCommand;
use App\Model\History\History;
use App\Model\Paragraph\ParagraphInterface;

class Document implements DocumentInterface
{
    private string $title = '';

    private History $history;

    /**
     * @var DocumentItem[]
     */
    private array $items = [];

    public function __construct()
    {
        $this->history = new History();
    }

    public function insertParagraph(string $text, ?int $position = null): ParagraphInterface
    {
        $paragraph = null;
        $this->history->addAndExecuteCommand(new InsertParagraphCommand($this->items, $text, $position, $paragraph));
        return $paragraph;
    }

    //public function insertImage(string $path, int $width, int $height, ?int $position = null): ImageInterface;

    public function getItemCount(): int
    {
        return count($this->items);
    }

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