<?php

namespace Tests\Unit\Painter;

use App\Canvas\CanvasInterface;
use App\Draft\PictureDraft;
use App\Painter\Painter;
use PHPUnit\Framework\TestCase;

class PainterTest extends TestCase
{
    public function testDrawPicture(): void
    {
        $draft = $this->createMock(PictureDraft::class);
        $canvas = $this->createMock(CanvasInterface::class);

        $count = 10;
        $draft->method('getShapeCount')->willReturn($count);

        $painter = new Painter();

        $draft->expects($this->once())->method('getShapeCount');
        $draft->expects($this->exactly($count))->method('getShape');

        $painter->drawPicture($draft, $canvas);
    }
}