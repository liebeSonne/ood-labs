<?php

namespace Test\Unit\Model\Document;

use App\Model\Document\ConstDocumentItem;
use App\Model\Image\ImageInterface;
use App\Model\Paragraph\ParagraphInterface;
use PHPUnit\Framework\TestCase;

class ConstDocumentItemTest extends TestCase
{
    public function testConstructor(): void
    {
        $image = $this->createMock(ImageInterface::class);
        $paragraph = $this->createMock(ParagraphInterface::class);

        $item = new ConstDocumentItem($image, $paragraph);

        $this->assertEquals($image, $item->getImage());
        $this->assertEquals($paragraph, $item->getParagraph());
    }

    public function testConstructorNull(): void
    {
        $item = new ConstDocumentItem(null, null);

        $this->assertNull($item->getImage());
        $this->assertNull($item->getParagraph());
    }
}