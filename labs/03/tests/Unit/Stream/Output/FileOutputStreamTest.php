<?php

namespace Tests\Unit\Stream\Output;

use App\Stream\Output\FileOutputStream;
use PHPUnit\Framework\TestCase;

class FileOutputStreamTest extends TestCase
{
    public function testWriteByte(): void
    {
        $filename = 'file.tmp';
        @unlink($filename);
        file_put_contents($filename, '');

        $stream = new FileOutputStream($filename);

        $str = '123';
        $stream->writeByte($str);

        $content = file_get_contents($filename);

        $this->assertEquals($str, $content);
        @unlink($filename);
    }

    public function testWriteBlock(): void
    {
        $filename = 'file.tmp';
        $filename2 = 'file2.tmp';
        @unlink($filename);
        @unlink($filename2);
        file_put_contents($filename, '');

        $str = '123456';
        $size = 3;
        $result = substr($str, 0, $size);
        file_put_contents($filename2, $str);

        $stream = new FileOutputStream($filename);
        $srcData = new \SplFileObject($filename2);

        $stream->writeBlock($srcData, $size);

        $content = file_get_contents($filename);

        $this->assertEquals($result, $content);

        @unlink($filename);
        @unlink($filename2);
    }
}
