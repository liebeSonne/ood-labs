<?php

namespace App\Model\Document;

use App\Command\Document\ChangeStringCommand;
use App\Command\Document\DeleteItemCommand;
use App\Command\Document\InsertImageCommand;
use App\Command\Document\InsertParagraphCommand;
use App\Command\Document\ReplaceTextCommand;
use App\Command\Document\ResizeImageCommand;
use App\Model\History\History;
use App\Model\Image\ImageInterface;
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

    public function insertImage(string $path, int $width, int $height, ?int $position = null): ImageInterface
    {
        $image = null;
        $this->history->addAndExecuteCommand(new InsertImageCommand($this->items, $path, $width, $height, $position, $image));
        return $image;
    }

    public function getItemCount(): int
    {
        return count($this->items);
    }

    public function getItemConst(int $index): ?ConstDocumentItem
    {
        return $this->items[$index] ?? null;
    }

    public function getItem(int $index): ?DocumentItem
    {
        return $this->items[$index] ?? null;
    }

    public function deleteItem(int $index): void
    {
        $this->history->addAndExecuteCommand(new DeleteItemCommand($this->items, $index));
    }

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

    public function replaceParagraphText(int $position, string $text): void
    {
        $item = $this->getItem($position);
        if ($item === null) return;
        $paragraph = $item->getParagraph();
        if ($paragraph === null) return;
        $this->history->addAndExecuteCommand(new ReplaceTextCommand($paragraph, $text));
    }

    public function resizeImage(int $position, int $width, int $height): void
    {
        $item = $this->getItem($position);
        if ($item === null) return;
        $image = $item->getImage();
        if ($image === null) return;
        $this->history->addAndExecuteCommand(new ResizeImageCommand($image, $width, $height));
    }
}