<?php

namespace Tests\Unit\Model\Document;

use App\Model\Document\Document;
use App\Model\Image\ImageInterface;
use App\Model\Paragraph\ParagraphInterface;
use PHPUnit\Framework\TestCase;

class DocumentTest extends TestCase
{
    public function testSetGetTitle(): void
    {
        $document = new Document();
        $title = 'title';
        $document->setTitle($title);
        $this->assertEquals($title, $document->getTitle());
    }

    public function testCanUndo(): void
    {
        $document = new Document();
        $can = $document->canUndo();
        $this->assertIsBool($can);
        $this->assertFalse($can);
    }

    public function testCanRedo(): void
    {
        $document = new Document();
        $can = $document->canRedo();
        $this->assertIsBool($can);
        $this->assertFalse($can);
    }

    //public function testUndo(): void;

    //public function testRedo(): void;

    public function testInsertParagraph(): void
    {
        $document = new Document();
        $text = 'text';
        $position = 0;

        $paragraph = $document->insertParagraph($text, $position);

        $this->assertInstanceOf(ParagraphInterface::class, $paragraph);
    }

    public function testInsertParagraphNullPosition(): void
    {
        $document = new Document();
        $text = 'text';
        $position = null;

        $paragraph = $document->insertParagraph($text, $position);

        $this->assertInstanceOf(ParagraphInterface::class, $paragraph);
    }

    public function testInsertImage(): void
    {
        $document = new Document();
        $position = 1;
        $width = 100;
        $height = 100;

        $path = $this->createFile($width, $height);

        $image = $document->insertImage($path, $width, $height, $position);

        $this->assertInstanceOf(ImageInterface::class, $image);

        @unlink($path);
    }

    public function testInsertImageNullPoint(): void
    {
        $document = new Document();
        $position = null;
        $width = 100;
        $height = 100;

        $path = $this->createFile($width, $height);

        $image = $document->insertImage($path, $width, $height, $position);

        $this->assertInstanceOf(ImageInterface::class, $image);

        @unlink($path);
    }


    public function testGetItemCount(): void
    {
        $document = new Document();

        $this->assertIsInt($document->getItemCount());

        $this->assertEquals(0, $document->getItemCount());

        $document->insertParagraph('text');
        $this->assertEquals(1, $document->getItemCount());

        $document->insertParagraph('text');
        $this->assertEquals(2, $document->getItemCount());
    }

    private function createFile($width, $height): string
    {
        $path = './file.png';
        @unlink($path);
        $im = imagecreate($width, $height);
        $red = imagecolorallocate($im, 255, 0, 0);
        imagefill($im, 0, 0, $red);
        imagepng($im, $path);
        imagedestroy($im);
        return $path;
    }
}