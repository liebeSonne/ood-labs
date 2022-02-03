<?php

namespace Tests\Unit\Command\Document;

use App\Command\Document\InsertParagraphCommand;
use App\Model\Document\DocumentItem;
use App\Model\Paragraph\ParagraphInterface;
use PHPUnit\Framework\TestCase;

class InsertParagraphCommandTest extends TestCase
{
    public function testDoExecuteNullPosition(): void
    {
        $items = [];
        $text = 'text';
        $position = null;
        $paragraph = null;

        $command = new InsertParagraphCommand($items, $text, $position, $paragraph);

        $command->doExecute();

        $this->assertArrayHasKey(0, $items);
        $this->assertInstanceOf(DocumentItem::class, $items[0]);
        $this->assertEquals($paragraph, $items[0]->getParagraph());
        $this->assertInstanceOf(ParagraphInterface::class, $paragraph);
        $this->assertEquals($text, $paragraph->getText());
    }

    public function testDoExecuteNotNullPosition(): void
    {
        $items = [
            $this->createMock(DocumentItem::class),
            $this->createMock(DocumentItem::class),
        ];
        $text = 'text';
        $position = 1;
        $paragraph = null;

        $command = new InsertParagraphCommand($items, $text, $position, $paragraph);

        $command->doExecute();

        $this->assertArrayHasKey($position, $items);
        $this->assertInstanceOf(DocumentItem::class, $items[0]);
        $this->assertEquals($paragraph, $items[$position]->getParagraph());
        $this->assertInstanceOf(ParagraphInterface::class, $paragraph);
        $this->assertEquals($text, $paragraph->getText());
    }

    public function testDoUnexecuteNullPosition(): void
    {
        $items = [
            $this->createMock(DocumentItem::class),
            $this->createMock(DocumentItem::class),
        ];
        $text = 'text';
        $position = null;
        $paragraph = null;

        $command = new InsertParagraphCommand($items, $text, $position, $paragraph);

        $command->doUnexecute();

        $this->assertCount(1, $items);
    }

    public function testDoUnexecuteNotNullPosition(): void
    {
        $items = [
            $this->createMock(DocumentItem::class),
            $this->createMock(DocumentItem::class),
        ];
        $text = 'text';
        $position = 1;
        $paragraph = null;

        $command = new InsertParagraphCommand($items, $text, $position, $paragraph);

        $command->doUnexecute();

        $this->assertCount(1, $items);
    }

    public function testDoUnexecuteNotNullPositionMoreThenCount(): void
    {
        $items = [
            $this->createMock(DocumentItem::class),
            $this->createMock(DocumentItem::class),
        ];
        $text = 'text';
        $position = 2;
        $paragraph = null;

        $command = new InsertParagraphCommand($items, $text, $position, $paragraph);

        $command->doUnexecute();

        $this->assertCount(2, $items);
    }
}