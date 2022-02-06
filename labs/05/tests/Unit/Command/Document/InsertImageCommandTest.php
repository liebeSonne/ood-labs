<?php

namespace Tests\Unit\Command\Document;

use App\Command\Document\InsertImageCommand;
use App\Model\Document\DocumentItem;
use App\Model\Image\ImageInterface;
use PHPUnit\Framework\TestCase;

class InsertImageCommandTest extends TestCase
{
    public function testDoExecuteNullPosition(): void
    {
        $items = [];
        $width = 1024;
        $height = 756;
        $position = null;
        $image = null;

        $path = $this->createFile($width, $height);

        $command = new InsertImageCommand($items, $path, $width, $height, $position, $image);

        $command->execute();

        $this->assertArrayHasKey(0, $items);
        $this->assertInstanceOf(DocumentItem::class, $items[0]);
        $this->assertEquals($image, $items[0]->getImage());
        $this->assertInstanceOf(ImageInterface::class, $image);

        @unlink($path);
    }

    public function testDoExecuteNotNullPosition(): void
    {
        $items = [
            $this->createMock(DocumentItem::class),
            $this->createMock(DocumentItem::class),
        ];
        $width = 1024;
        $height = 756;
        $position = 1;
        $image = null;

        $path = $this->createFile($width, $height);

        $command = new InsertImageCommand($items, $path, $width, $height, $position, $image);

        $command->execute();

        $this->assertArrayHasKey($position, $items);
        $this->assertInstanceOf(DocumentItem::class, $items[0]);
        $this->assertEquals($image, $items[$position]->getImage());
        $this->assertInstanceOf(ImageInterface::class, $image);

        @unlink($path);
    }

    public function testDoUnexecuteNullPosition(): void
    {
        $items = [
            $this->createMock(DocumentItem::class),
            $this->createMock(DocumentItem::class),
        ];
        $width = 1024;
        $height = 756;
        $position = null;
        $image = null;

        $path = $this->createFile($width, $height);

        $command = new InsertImageCommand($items, $path, $width, $height, $position, $image);

        $command->execute();
        $command->unexecute();

        $this->assertCount(2, $items);

        @unlink($path);
    }

    public function testDoUnexecuteNotNullPosition(): void
    {
        $items = [
            $this->createMock(DocumentItem::class),
            $this->createMock(DocumentItem::class),
        ];
        $width = 1024;
        $height = 756;
        $position = 1;
        $image = null;

        $path = $this->createFile($width, $height);

        $command = new InsertImageCommand($items, $path, $width, $height, $position, $image);

        $command->execute();
        $command->unexecute();

        $this->assertCount(2, $items);

        @unlink($path);
    }

    public function testDoUnexecuteNotNullPositionMoreThenCount(): void
    {
        $items = [
            $this->createMock(DocumentItem::class),
            $this->createMock(DocumentItem::class),
        ];
        $width = 1024;
        $height = 756;
        $position = 2;
        $image = null;

        $path = $this->createFile($width, $height);

        $command = new InsertImageCommand($items, $path, $width, $height, $position, $image);

        $command->execute();
        $command->unexecute();

        $this->assertCount(2, $items);
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