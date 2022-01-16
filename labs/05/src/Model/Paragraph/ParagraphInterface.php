<?php

namespace App\Model\Paragraph;

interface ParagraphInterface
{
    public function getText(): string;

    public function setText(string $text): void;
}