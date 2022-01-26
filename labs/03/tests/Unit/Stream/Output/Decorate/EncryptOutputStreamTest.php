<?php

namespace Tests\Unit\Stream\Output\Decorate;

use App\Stream\Output\Decorate\EncryptOutputStream;
use App\Stream\Output\OutputDataStreamInterface;
use PHPUnit\Framework\TestCase;

class EncryptOutputStreamTest extends TestCase
{
    public function testWriteByte() : void
    {
        $output = $this->createMock(OutputDataStreamInterface::class);

        $stream = new EncryptOutputStream($output);

        $output->expects($this->once())->method('writeByte');

        $str = 'a';
        $stream->writeByte($str);
    }

    public function testWriteBlock() : void
    {
        $output = $this->createMock(OutputDataStreamInterface::class);

        $stream = new EncryptOutputStream($output);

        $size = 3;
        $output->expects($this->once())->method('writeBlock');

        $srcData = new \SplFileObject('php://temp','w+b');

        $stream->writeBlock($srcData, $size);
    }
}
