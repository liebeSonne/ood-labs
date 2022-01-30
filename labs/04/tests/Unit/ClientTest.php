<?php

namespace Tests\Unit;

use App\Canvas\CanvasInterface;
use App\Client;
use App\Designer\DesignerInterface;
use App\Painter\Painter;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testMain(): void
    {
        $designer = $this->createMock(DesignerInterface::class);
        $painter = $this->createMock(Painter::class);
        $canvas = $this->createMock(CanvasInterface::class);

        $stream = STDIN;
        $client = new Client($designer, $painter, $canvas);

        $designer->expects($this->once())->method('createDraft');
        $painter->expects($this->once())->method('drawPicture');

        $client->main($stream);
    }
}