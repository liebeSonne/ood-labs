<?php

namespace Test\Unit\Model\Document;

use App\Model\Document\DocumentItem;
use App\Model\Image\ImageInterface;
use App\Model\Paragraph\ParagraphInterface;
use PHPUnit\Framework\TestCase;

class DocumentItemTest extends TestCase
{
    public function testConstructor(): void
    {
        $image = $this->createMock(ImageInterface::class);
        $paragraph = $this->createMock(ParagraphInterface::class);

        $item = new DocumentItem($image, $paragraph);

        $this->assertEquals($image, $item->getImage());
        $this->assertEquals($paragraph, $item->getParagraph());
    }

    public function testConstructorNull(): void
    {
        $item = new DocumentItem(null, null);

        $this->assertNull($item->getImage());
        $this->assertNull($item->getParagraph());
    }

    public function testSetGetImage(): void
    {
        $image = $this->createMock(ImageInterface::class);

        $item = new DocumentItem();
        $item->setImage($image);

        $this->assertEquals($image, $item->getImage());
    }

    public function testSetGetParagraph(): void
    {
        $paragraph = $this->createMock(ParagraphInterface::class);

        $item = new DocumentItem();
        $item->setParagraph($paragraph);

        $this->assertEquals($paragraph, $item->getParagraph());
    }
}