<?php

namespace App\Model\Document;

interface DocumentInterface
{
    //public function insertParagraph(string $text, ?int $position = null): ParagraphInterface;

    //public function insertImage(string $path, int $width, int $height, ?int $position = null): ImageInterface;

    //public function getItemCount(): int;

    //public function getItem(int $index): ConstDocumentItem;

    //public function getItem(int $index): DocumentItem;

    //public function deleteItem(int $index): void;

    public function getTitle(): string;

    public function setTitle(string $title): void;

    public function canUndo(): bool;

    public function undo(): void;

    public function canRedo(): bool;

    public function redo(): void;

    //public function save(string $path): void;
}