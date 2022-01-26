<?php

namespace Tests\Unit\Stream\Input\Decorate;

use App\Stream\Input\Decorate\DecompressInputStream;
use App\Stream\Input\InputDataStreamInterface;
use PHPUnit\Framework\TestCase;

class DecompressInputStreamTest extends TestCase
{
    public function testisEOFFalse(): void
    {
        $input = $this->createMock(InputDataStreamInterface::class);

        $stream = new DecompressInputStream($input);

        $this->assertFalse($stream->isEOF());
    }

    public function testisEOFTrue(): void
    {
        $input = $this->createMock(InputDataStreamInterface::class);
        $input->method('isEOF')->willReturn(true);

        $stream = new DecompressInputStream($input);

        $this->assertTrue($stream->isEOF());
    }

    public function testReadByte(): void
    {
        $input = $this->createMock(InputDataStreamInterface::class);
        $input->method('readByte')->will($this->onConsecutiveCalls('a','2','b','1'));

        $stream = new DecompressInputStream($input);

        $str = $stream->readByte();
        $this->assertEquals('a', $str);
        $str = $stream->readByte();
        $this->assertEquals('a', $str);
        $str = $stream->readByte();
        $this->assertEquals('b', $str);
    }

    public function testReadBlock(): void
    {
        $filename = 'file.tmp';
        @unlink($filename);
        file_put_contents($filename, '');

        $input = $this->createMock(InputDataStreamInterface::class);
        $input->method('readByte')->will($this->onConsecutiveCalls('a','2','b','1'));

        $stream = new DecompressInputStream($input);

        $size = 3;
        $dstBuffer = new \SplFileObject($filename,'w+b');
        $count = $stream->readBlock($dstBuffer, $size);

        $this->assertEquals($size, $count);

        $dstBuffer->fseek(0);
        $content = $dstBuffer->fread(1000);

        $this->assertEquals('aab', $content);

        @unlink($filename);
    }
}