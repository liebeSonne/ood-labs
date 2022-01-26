<?php

namespace Tests\Unit\Stream\Input\Decorate;

use App\Stream\Input\Decorate\InputStreamDecoration;
use App\Stream\Input\InputDataStreamInterface;
use PHPUnit\Framework\TestCase;

class InputStreamDecorationTest extends TestCase
{

    public function testIsEOFTrue(): void
    {
        $input = $this->createMock(InputDataStreamInterface::class);
        $input->method('isEOF')->willReturn(true);

        $stream = new InputStreamDecoration($input);

        $this->assertTrue($stream->isEOF());
    }

    public function testIsEOFFalse(): void
    {
        $input = $this->createMock(InputDataStreamInterface::class);
        $input->method('isEOF')->willReturn(false);

        $stream = new InputStreamDecoration($input);

        $this->assertFalse($stream->isEOF());
    }

    public function testReadByte(): void
    {
        $input = $this->createMock(InputDataStreamInterface::class);
        $input->method('readByte')->will($this->onConsecutiveCalls('a', 'b', 'c'));

        $stream = new InputStreamDecoration($input);

        $this->assertEquals('a', $stream->readByte());
        $this->assertEquals('b', $stream->readByte());
        $this->assertEquals('c', $stream->readByte());
    }

    public function testReadBlock(): void
    {
        $input = $this->createMock(InputDataStreamInterface::class);
        $input->method('readBlock')->will(
            $this->returnCallback(
                static function ($dstBuffer, $size): int {
                    return $size;
                }
            )
        );

        $stream = new InputStreamDecoration($input);
        $dstBuffer = new \SplFileObject('php://temp');
        $size = 3;
        $count = $stream->readBlock($dstBuffer, $size);

        $this->assertEquals($size, $count);
    }
}