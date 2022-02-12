<?php

namespace Tests\Unit\Command\Document;

use App\Command\Document\ResizeImageCommand;
use App\Model\Image\Image;
use App\Model\Image\ImageInterface;
use PHPUnit\Framework\TestCase;

class ResizeImageCommandTest extends TestCase
{
    public function testDoExecute(): void
    {
        $newWidth = 100;
        $newHeight = 200;
        $oldWidth = 20;
        $oldHeight = 30;

        $image = new Image('path', $oldWidth, $oldHeight);

        $command = new ResizeImageCommand($image, $newWidth, $newHeight);

        $command->execute();

        $this->assertEquals($newWidth, $image->getWidth());
        $this->assertEquals($newHeight, $image->getHeight());
    }

    public function testDoUnexecute(): void
    {
        $newWidth = 100;
        $newHeight = 200;
        $oldWidth = 20;
        $oldHeight = 30;

        $image = new Image('path', $oldWidth, $oldHeight);

        $command = new ResizeImageCommand($image, $newWidth, $newHeight);

        $command->execute();
        $command->unexecute();

        $this->assertEquals($oldWidth, $image->getWidth());
        $this->assertEquals($oldHeight, $image->getHeight());
    }
}