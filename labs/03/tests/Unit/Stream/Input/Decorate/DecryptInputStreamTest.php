<?php

namespace Tests\Unit\Stream\Input\Decorate;

use App\Stream\Algorithm\ReplaceCryptAlgorithm;
use App\Stream\Input\Decorate\DecryptInputStream;
use App\Stream\Input\InputDataStreamInterface;
use PHPUnit\Framework\TestCase;

class DecryptInputStreamTest extends TestCase
{
    public function testReadByte(): void
    {
        $input = $this->createMock(InputDataStreamInterface::class);
        $input->method('readByte')->will($this->onConsecutiveCalls('a','b','c'));

        $seed = 0;
        $alg = new ReplaceCryptAlgorithm($seed);
        $stream = new DecryptInputStream($input, $alg);

        $input->expects($this->once())->method('readByte');

        $stream->readByte();
    }

    public function testReadBlock(): void
    {
        $filename = 'file.tmp';
        @unlink($filename);
        file_put_contents($filename, '');

        $input = $this->createMock(InputDataStreamInterface::class);
        $input->method('readByte')->will($this->onConsecutiveCalls('a','b','c'));
        $input->method('readBlock')->will(
            $this->returnCallback(
                static function ($dstBuffer, $size): int {
                    return $size;
                }
            )
        );

        $seed = 0;
        $alg = new ReplaceCryptAlgorithm($seed);
        $stream = new DecryptInputStream($input, $alg);

        $size = 3;
        $dstBuffer = new \SplFileObject($filename,'w+b');
        $count = $stream->readBlock($dstBuffer, $size);

        $this->assertEquals($size, $count);

        @unlink($filename);
    }
}