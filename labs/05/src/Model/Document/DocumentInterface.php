<?php

namespace App\Model\Document;

use App\Model\Image\ImageInterface;
use App\Model\Paragraph\ParagraphInterface;

interface DocumentInterface
{
    public function insertParagraph(string $text, ?int $position = null): ParagraphInterface;

    public function insertImage(string $path, int $width, int $height, ?int $position = null): ImageInterface;

    public function getItemCount(): int;

    public function getItemConst(int $index): ?ConstDocumentItem;

    public function getItem(int $index): ?DocumentItem;

    public function deleteItem(int $index): void;

    public function getTitle(): string;

    public function setTitle(string $title): void;

    public function canUndo(): bool;

    public function undo(): void;

    public function canRedo(): bool;

    public function redo(): void;

    //public function save(string $path): void;

    public function replaceParagraphText(int $position, string $text): void;

    public function resizeImage(int $position, int $width, int $height): void;
}