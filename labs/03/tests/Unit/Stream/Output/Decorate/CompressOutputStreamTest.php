<?php

namespace Tests\Unit\Stream\Output\Decorate;

use App\Stream\Output\Decorate\CompressOutputStream;
use App\Stream\Output\OutputDataStreamInterface;
use PHPUnit\Framework\TestCase;

class CompressOutputStreamTest extends TestCase
{
    public function testWriteByte() : void
    {
        $output = $this->createMock(OutputDataStreamInterface::class);

        $stream = new CompressOutputStream($output);

        $output->expects($this->exactly(2))->method('writeByte');

        $str = 'a';
        $stream->writeByte($str);
        $stream->writeByte('');
    }

    public function testWriteBlock() : void
    {
        $output = $this->createMock(OutputDataStreamInterface::class);

        $stream = new CompressOutputStream($output);

        $size = 3;
        $output->expects($this->exactly($size))->method('writeByte');

        $srcData = new \SplFileObject('php://temp','w+b');

        $stream->writeBlock($srcData, $size);
    }
}
