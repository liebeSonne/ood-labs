<?php

namespace Tests\Unit\Stream\Input;

use App\Stream\Input\FileInputStream;
use PHPUnit\Framework\TestCase;

class FileInputStreamTest extends TestCase
{
    private $filename;

    public function testIsEOFFalse(): void
    {
        $filename = 'file.tmp';
        @unlink($filename);
        file_put_contents($filename, '123');
        $stream = new FileInputStream($filename);

        $this->assertFalse($stream->isEOF());
        @unlink($filename);
    }

    public function testIsEOFTrue(): void
    {
        $filename = 'file.tmp';
        @unlink($filename);
        file_put_contents($filename, '');

        $stream = new FileInputStream($filename);

        $this->assertTrue($stream->isEOF());

        @unlink($filename);
    }

    public function testReadByte(): void
    {
        $filename = 'file.tmp';
        @unlink($filename);
        file_put_contents($filename, '123');

        $stream = new FileInputStream($filename);

        $str = $stream->readByte();
        $this->assertEquals('1', $str);
        $str = $stream->readByte();
        $this->assertEquals('2', $str);

        @unlink($filename);
    }

    public function testReadBlock(): void
    {
        $filename = 'file.tmp';
        @unlink($filename);
        file_put_contents($filename, '123');

        $fileOut = 'fileOut.tmp';
        @unlink($fileOut);
        file_put_contents($fileOut, '');

        $dst = new \SplFileObject($fileOut, 'ab');

        $size = 2;
        $stream = new FileInputStream($filename);

        $result = $stream->readBlock($dst, $size);

        $this->assertEquals($size, $result);

        $this->assertEquals('12', file_get_contents($fileOut));

        @unlink($filename);
        @unlink($fileOut);
    }
}