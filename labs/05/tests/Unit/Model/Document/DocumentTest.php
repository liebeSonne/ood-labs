<?php

namespace Tests\Unit\Model\Document;

use App\Model\Document\Document;
use App\Model\Image\ImageInterface;
use App\Model\Paragraph\ParagraphInterface;
use PhpParser\Comment\Doc;
use PHPUnit\Framework\TestCase;

class DocumentTest extends TestCase
{
    private array $files = [];

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
        $this->files[] = $image->getPath();

        $this->assertInstanceOf(ImageInterface::class, $image);
    }

    public function testInsertImageNullPoint(): void
    {
        $document = new Document();
        $position = null;
        $width = 100;
        $height = 100;

        $path = $this->createFile($width, $height);

        $image = $document->insertImage($path, $width, $height, $position);
        $this->files[] = $image->getPath();

        $this->assertInstanceOf(ImageInterface::class, $image);
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

    public function testReplaceParagraphText(): void
    {
        $document = new Document();

        $position = 0;
        $text = 'text';
        $text2 = 'text 2';
        $newText = 'New text';

        $document->insertParagraph($text, 0);
        $document->insertParagraph($text2, 1);

        $document->replaceParagraphText($position, $newText);

        $this->assertEquals($newText, $document->getItem($position)->getParagraph()->getText());
    }

    public function testResizeImage(): void
    {
        $document = new Document();

        $position = 0;
        $width = 100;
        $height = 200;
        $newWidth = 400;
        $newHeight = 300;

        $path = $this->createFile($width, $height);

        $image = $document->insertImage($path, $width, $height, $position);
        $this->files[] = $image->getPath();

        $document->resizeImage($position, $newWidth, $newHeight);

        $this->assertEquals($newWidth, $document->getItem($position)->getImage()->getWidth());
        $this->assertEquals($newHeight, $document->getItem($position)->getImage()->getHeight());
    }

    public function testDeleteItem(): void
    {
        $document = new Document();
        $document->insertParagraph('text1');
        $document->insertParagraph('text2');
        $document->insertParagraph('text3');

        $document->deleteItem(1);

        $this->assertEquals(2, $document->getItemCount());
    }

    public function testDeleteItemIncorrectPosition(): void
    {
        $document = new Document();
        $document->insertParagraph('text1');
        $document->insertParagraph('text2');
        $document->insertParagraph('text3');

        $document->deleteItem(10);

        $this->assertEquals(3, $document->getItemCount());
    }

    public function testSaveToPath(): void
    {
        $document = new Document();

        $path = '';
        $documentFile = $path . '/index.html';
        $documentImagesDir = $path . '/images';

        $document->save($documentFile);

        $this->assertFileExists($documentFile);

        @unlink($documentFile);
        $this->removeDir($documentImagesDir);
    }

    public function testSaveToFileHtml(): void
    {
        $document = new Document();

        $path = './file.html';
        $documentFile = $path;
        $documentImagesDir = $path . '/images';

        $document->save($documentFile);

        $this->assertFileExists($documentFile);

        @unlink($documentFile);
        $this->removeDir($documentImagesDir);
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
        $this->files[] = $path;
        return $path;
    }

    private function removeDir($dir) : bool
    {
        if (!is_dir($dir)) return false;
        $files = array_diff(scandir($dir), ['.','..']);
        foreach ($files as $file) {
            if (is_dir($dir . '/' . $file)) {
                $this->removeDir($dir . '/' . $file);
            } else {
                @unlink($dir.'/'.$file);
            }
        }
        return @rmdir($dir);
    }

    public function __destruct()
    {
        foreach ($this->files as $file) {
            @unlink($file);
        }
    }
}