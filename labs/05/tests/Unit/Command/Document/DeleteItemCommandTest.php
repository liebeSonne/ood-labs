<?php

namespace Tests\Unit\Command\Document;

use App\Command\Document\DeleteItemCommand;
use App\Model\Document\DocumentItem;
use App\Model\Image\Image;
use PHPUnit\Framework\TestCase;

class DeleteItemCommandTest extends TestCase
{
    private array $files = [];

    public function testDoExecute(): void
    {
        $items = [
            new DocumentItem(),
            new DocumentItem(),
        ];
        $position = 1;

        $command = new DeleteItemCommand($items, $position);

        $command->execute();

        $this->assertCount(1, $items);
    }

    public function testDoExecuteUnknownPosition(): void
    {
        $items = [
            new DocumentItem(),
            new DocumentItem(),
        ];
        $position = 10;

        $command = new DeleteItemCommand($items, $position);

        $command->execute();

        $this->assertCount(2, $items);
    }

    public function testDoUnexecute(): void
    {
        $items = [
            $this->createMock(DocumentItem::class),
            $this->createMock(DocumentItem::class),
        ];
        $position = 1;

        $command = new DeleteItemCommand($items, $position);

        $command->execute();
        $command->unexecute();

        $this->assertCount(2, $items);
    }

    public function testRemoveResource(): void
    {
        $width = 1024;
        $height = 756;
        $path = $this->createFile($width, $height);

        $item = new DocumentItem();
        $item->setImage(new Image($path, $width, $height));
        $items = [
            $item,
        ];
        $position = 0;

        $command = new DeleteItemCommand($items, $position);

        $command->execute();

        $command->destroy();

        $this->assertFileDoesNotExist($path);
    }

    public function testDontRemoveResource(): void
    {
        $width = 1024;
        $height = 756;
        $path = $this->createFile($width, $height);

        $item = new DocumentItem();
        $item->setImage(new Image($path, $width, $height));
        $items = [
            $item,
        ];
        $position = 0;

        $command = new DeleteItemCommand($items, $position);

        $command->execute();
        $command->unexecute();

        $this->assertFileExists($path);
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

    public function __destruct()
    {
        foreach ($this->files as $file) {
            @unlink($file);
        }
    }
}