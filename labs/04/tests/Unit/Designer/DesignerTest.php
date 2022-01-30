<?php

namespace Tests\Unit\Designer;

use App\Designer\Designer;
use App\Factory\ShapeFactoryInterface;
use PHPUnit\Framework\TestCase;

class DesignerTest extends TestCase
{
    public function testCreateDraft(): void
    {
        $factory = $this->createMock(ShapeFactoryInterface::class);

        $designer = new Designer($factory);

        $text = "ellipse 0 0 10 5 red\npolygon 0 0 10 5 white";
        $stream = fopen('php://temp', 'w+b');
        fwrite($stream, $text);
        fseek($stream,0);

        $factory->expects($this->exactly(2))->method('createShape');

        $designer->createDraft($stream);
    }
};