<?php

namespace Tests\Unit\Stream\Input;

use App\Stream\Input\MemoryInputStream;
use PHPUnit\Framework\TestCase;

class MemoryInputStreamTest extends TestCase
{
    public function testIsEOFFalse(): void
    {
        $stream = new MemoryInputStream();

        $this->assertFalse($stream->isEOF());
    }

    public function testIsEOFTrue(): void
    {
        $stream = new MemoryInputStream();
        $stream->readByte();

        $this->assertTrue($stream->isEOF());
    }

    public function testReadByte(): void
    {
        $stream = new MemoryInputStream();
        $str = $stream->readByte();

        $this->assertIsString($str);
    }

    public function testReadBlock(): void
    {
        $dstBuffer = new \SplFileObject('php://temp');

        $size = 1;
        $stream = new MemoryInputStream();
        $result = $stream->readBlock($dstBuffer, $size);

        $this->assertEquals($size, $result);
    }
}