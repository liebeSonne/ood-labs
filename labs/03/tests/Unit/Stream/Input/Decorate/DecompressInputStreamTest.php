<?php

namespace Tests\Unit\Stream\Input\Decorate;

use App\Stream\Input\Decorate\DecompressInputStream;
use App\Stream\Input\Decorate\InputStreamDecoration;
use App\Stream\Input\FileInputStream;
use App\Stream\Input\InputDataStreamInterface;
use App\Stream\Output\Decorate\CompressOutputStream;
use App\Stream\Output\FileOutputStream;
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

    public function testCompressDecompress(): void
    {
        $charCounts = [
            'a' => 500,
            'b' => 100,
            'd' => 255,
            'e' => 510,
            'f' => 1,
            'g' => 260,
            'h' => 511,
            'j' => 254,
            'k' => 509,
            'l' => 765,
            'm' => 766,
        ];
        $str = '';
        foreach ($charCounts as $ch => $count) {
            $str .= str_repeat($ch, $count);
        }

        $inFile = 'in_file.tmp';
        $distFile = 'dist_compressed_file.tmp';
        $outFile = 'out_file.tmp';

        @unlink($inFile);
        @unlink($inFile);
        @unlink($distFile);

        file_put_contents($inFile, $str);
        file_put_contents($outFile, '');
        file_put_contents($distFile, '');

        $size = strlen($str);

        // inFile => distFile
        $srcBuffer = new \SplFileObject($inFile,'r+b');
        $output = new FileOutputStream($distFile);
        $compressor = new CompressOutputStream($output);
        $compressor->writeBlock($srcBuffer, $size);
        $compressor->close();

        // distFile => outFIle
        $dstBuffer = new \SplFileObject($outFile,'w+b');
        $input = new FileInputStream($distFile);
        $decompressor = new DecompressInputStream($input);
        $size = filesize($inFile);
        $count = $decompressor->readBlock($dstBuffer, $size);

        $in = file_get_contents($inFile);
        $out = file_get_contents($outFile);
        $dist = file_get_contents($distFile);

        $this->assertEquals($str, $in);
        $this->assertEquals($dist, $out);
        $this->assertEquals($str, $out);

        @unlink($inFile);
        @unlink($outFile);
        @unlink($distFile);
    }
}