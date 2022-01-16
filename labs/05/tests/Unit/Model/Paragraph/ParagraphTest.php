<?php

namespace Tests\Unit\Model\Paragraph;

use App\Model\Paragraph\Paragraph;
use PHPUnit\Framework\TestCase;

class ParagraphTest extends TestCase
{
    public function testSetConstructorGetText(): void
    {
        $text = 'text';
        $paragraph = new Paragraph($text);
        $this->assertEquals($text, $paragraph->getText());
    }

    public function testSetGetText(): void
    {
        $text = 'text';
        $paragraph = new Paragraph();
        $paragraph->setText($text);
        $this->assertEquals($text, $paragraph->getText());
    }
}