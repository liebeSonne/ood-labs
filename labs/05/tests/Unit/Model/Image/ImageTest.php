<?php

namespace Tests\Unit\Model\Image;

use App\Model\Image\Image;
use PHPUnit\Framework\TestCase;

class ImageTest extends TestCase
{
    public function testGetters(): void
    {
        $path = './path/to/file.png';
        $width = 1024;
        $height = 756;

        $image = new Image($path, $width, $height);

        $this->assertEquals($path, $image->getPath());
        $this->assertEquals($width, $image->getWidth());
        $this->assertEquals($height, $image->getHeight());
    }

    public function testSetters(): void
    {
        $path = './path/to/file.png';
        $width = 1024;
        $height = 756;
        $newWidth = 256;
        $newHeight = 128;

        $image = new Image($path, $width, $height);

        $image->resize($newWidth, $newHeight);

        $this->assertEquals($newWidth, $image->getWidth());
        $this->assertEquals($newHeight, $image->getHeight());
    }
}