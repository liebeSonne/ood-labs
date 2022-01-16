<?php

namespace App\Model\Paragraph;

class Paragraph implements ParagraphInterface
{
    private string $text = '';

    public function __construct(string $text = '')
    {
        $this->setText($text);
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }
}