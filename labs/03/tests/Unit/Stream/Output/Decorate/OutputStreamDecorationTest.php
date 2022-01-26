<?php

namespace Tests\Unit\Stream\Output\Decorate;

use App\Stream\Output\Decorate\OutputStreamDecoration;
use App\Stream\Output\OutputDataStreamInterface;
use PHPUnit\Framework\TestCase;

class OutputStreamDecorationTest extends TestCase
{
    public function testWriteByte() : void
    {
        $output = $this->createMock(OutputDataStreamInterface::class);

        $stream = new OutputStreamDecoration($output);

        $output->expects($this->once())->method('writeByte');

        $str = '123';
        $stream->writeByte($str);
    }

    public function testWriteBlock() : void
    {
        $output = $this->createMock(OutputDataStreamInterface::class);

        $stream = new OutputStreamDecoration($output);

        $output->expects($this->once())->method('writeBlock');

        $size = 3;
        $srcData = new \SplFileObject('php://temp');

        $stream->writeBlock($srcData, $size);
    }
}
